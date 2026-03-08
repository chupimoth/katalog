<?php
declare(strict_types=1);

namespace App\Presentation\Ebooks;

use Nette;
use Nette\Application\UI\Presenter;
use Nette\Application\UI\Form;
use App\Components\MyPaginator\MyPaginator;
use App\Model\EbookModel;

final class EbooksPresenter extends \App\Core\BasePresenter
{
    private int $perPage = 5;

    public function __construct(private EbookModel $ebookModel)
    {        
    }

    public function actionList(): void
    {
        $http = $this->getHttpRequest();
        $page = max(1, (int)$http->getQuery('page', 1));
        $offset = ($page - 1) * $this->perPage;

        $total = $this->ebookModel->countAll();
        $items = $this->ebookModel->getAll($this->perPage, $offset);

        $this->template->items = array_map(fn($r) => $r->toArray(), $items);
        $this->template->page = $page;
        $this->template->perPage = $this->perPage;
        $this->template->total = $total;
    }

    protected function createComponentEbookForm(): Form
    {
        $form = new Form;

        $form->addText('title', 'Název:')
            ->setRequired();
        $form->addText('author', 'Autor:')->setRequired();
        $form->addText('genre', 'Žánr:');
        $form->addInteger('year', 'Rok vydání:')
            ->addRule($form::RANGE, 'Rok musí být v rozmezí 0-9999', [0, 9999]);
        $form->addText('price', 'Cena:');
        $form->addInteger('rating', 'Hodnocení:')
            ->addRule($form::RANGE, 'Hodnocení musí být 0-10', [0, 10]);
        $form->addTextArea('description', 'Popis:');
        $form->addSubmit('send', 'Uložit')->setHtmlAttribute("class","btn btn-primary");

        $form->onSuccess[] = [$this, 'ebookFormSucceeded'];
        return $form;
    }

    public function ebookFormSucceeded(Form $form, \stdClass $values): void
    {
        if($this->getAction() === "add"){
            $this->ebookModel->insert([
                'title' => $values->title,
                'author' => $values->author,
                'genre' => $values->genre,
                'year' => $values->year,
                'price' => $values->price,
                'rating' => $values->rating,
                'description' => $values->description,
                'created_at' => new \DateTimeImmutable(),
                'updated_at' => new \DateTimeImmutable(),
                'created_by' => $this->user->getId()
            ]);
            $this->flashMessage('E-book byl úspěšně uložen');
        } else {
            $id = $this->getParameter("id");
            $this->ebookModel->update((int)$id, [
                'title' => $values->title,
                'author' => $values->author,
                'genre' => $values->genre,
                'year' => $values->year,
                'price' => $values->price,
                'rating' => $values->rating,
                'description' => $values->description,
                'updated_at' => new \DateTimeImmutable(),
                'edited_by' => $this->user->getId()
            ]);
            $this->flashMessage('E-book byl úspěšně upraven');
        }

        $this->redirect('list');
    }

    protected function createComponentPaginator(): MyPaginator
    {
        $paginator = new MyPaginator();
        $paginator->itemsPerPage = $this->perPage;
        $paginator->totalItems = $this->ebookModel->countAll();
        $paginator->currentPage = (int)$this->getParameter('page', 1);
        $paginator->action = 'Ebooks:list';

        return $paginator;
    }

    public function actionEdit(int $id)
    {
        $ebook = $this->ebookModel->getById($id);
        if (!$ebook) {
            $this->error('E-book nenalezen');
        }

        $this['ebookForm']->setDefaults([
            'title' => $ebook->title ?? null,
            'author' => $ebook->author ?? null,
            'genre' => $ebook->genre ?? null,
            'year' => $ebook->year ?? null,
            'price' => $ebook->price ?? null,
            'rating' => $ebook->rating ?? null,
            'description' => $ebook->description ?? null,
        ]);
    }

    public function actionDelete(int $id)
    {
        $this->ebookModel->delete($id);
        $this->flashMessage('E-book byl úspěšně smazán');
        $this->redirect('Ebooks:list');
    }
}