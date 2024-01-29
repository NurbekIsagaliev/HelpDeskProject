<?php

class Pagination
{

    private $currentPage;
    private $maxPage;
    private $itemsCount;

    public function __construct($currentPage, $itemsCount, $limit)
    {
        $this->currentPage = $currentPage;
        $this->$itemsCount = intval($itemsCount);
        $this->maxPage = ceil($this->itemsCount / $limit);
    }

    public function render()
    {
?>
        <div class="my-5 mx-auto">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?php

                    $start = $this->currentPage - 1;
                    $end = $this->currentPage + 1;

                    if ($this->currentPage == 1) {

                        $start = $this->currentPage;
                        $end = $this->currentPage + 2;
                    } elseif ($this->maxPage == $this->currentPage) {
                        $end = $this->maxPage;
                        $start = $this->currentPage - 2;
                    }

                    for ($page = $start; $page <= $end; $page++) {
                    ?>
                        <li class="page-item
                        <?php if (($this->currentPage == 1 && $page == $this->currentPage) || ($this->maxPage == $this->currentPage && $page == $this->currentPage)) : ?> disabled<?php endif; ?>
                        <?php if ($page == $this->currentPage) : ?> active<?php endif; ?>
                            ">
                            <a class="page-link" href="?page=<?= $page ?>">
                                <?= $page ?>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
<?php
    }
}
