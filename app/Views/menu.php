<ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="<?= site_url('film-management') ?>">
                    <span data-feather="home"></span>
                    Film Management (CRUD)<span class="sr-only">(current)</span>
                </a>
            </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= site_url('film/rental') ?>">
                  <span data-feather="home"></span>
                  Rental (pagination) <span class="sr-only"></span>
                </a>
              </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('film/rentaldatatable') ?>">
                    <span data-feather="home"></span>
                    Rental (dataTable) <span class="sr-only"></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('upload') ?>">
                    <span data-feather="home"></span>
                    Sample Upload <span class="sr-only"></span>
                </a>
            </li>
</ul>