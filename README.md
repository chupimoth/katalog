E-books Catalog

Malá webová aplikace pro správu e-knih: výpis knih, detail, přidání a import přes JSON. Obsahuje veřejnou část pro prohlížení knih a administrační část s přihlášením.

Požadavky

PHP 8.x, MySQL/MariaDB nebo SQLite

Apache 2.4

Composer

Instalace

Naklonujte repozitář:

git clone https://github.com/chupimoth/katalog.git
cd katalog

Nainstalujte závislosti:

composer install

Vytvořte databázi a importujte demo data:

mysql -u uživatel -p ebooks < ebooks.sql

Dump obsahuje strukturu tabulky ebooks a ukázková data pro testování.

Přihlášení (admin)

/sign/in

Uživatelské jméno a heslo: user@example.com / heslo

Použití
Veřejné

/ebooks/list – seznam všech e-knih

/ebooks/detail?id=ID – detail knihy

Admin

/ebooks/add – přidání nové knihy

/ebooks/edit?id=ID – úprava knihy

/ebooks/import – import knih ze souboru books.json

/ebooks/delete?id=ID – smazání knihy

Tisk

Na stránce s výpisem knih je tlačítko "Tisk" (CSS pro tisk skryje nepotřebné prvky).

Struktura projektu
/app
  /Presentation
    /Ebooks
      EbooksPresenter.php
      list.latte
      detail.latte
      add.latte
      edit.latte
    BasePresenter.php
/css
/js
books.json
sql/ebooks.sql
index.php

Licence:
MIT