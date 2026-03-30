<aside class="main-sidebar sidebar-primary elevation-4">

    <a href="" class="brand-link">
        <div style="text-align: center; padding: 5px 0; background-color: #f8f9fa;">
            <img src="{{ asset('backend/AdminAssets/backend/dist/img/BrandPicture.png') }}"
                 alt="Logo"
                 style="width: 180px; height: 80px; object-fit: contain; display: block; margin: 0 auto;">
        </div>
    </a>

    <div class="sidebar">
        <nav class="mt-10" style="margin-top: 50px;">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                       class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                       class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                       class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Product</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<style>
    .nav-sidebar .nav-item .nav-link:hover {
        background-color: #007bff !important;
        color: #fff !important;
        position: relative;
    }

    .nav-sidebar .nav-item .nav-link:hover::after {
        content: "•";
        color: #1A237E;
        font-size: 18px;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
    }

    .nav-sidebar .nav-item .nav-link.active {
        background-color: #007bff !important;
        color: #1A237E !important;
        position: relative;
    }
    .nav-sidebar .nav-item .nav-link.active::after {
        content: "•";
        color: #1A237E;
        font-size: 18px;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
    }

    .nav-sidebar .nav-item .nav-link i.nav-icon {
        color: #343a40;
    }

    .nav-sidebar .nav-item .nav-link:hover i.nav-icon {
        color: #fff !important;
    }

    .nav-sidebar .nav-item .nav-link.active i.nav-icon {
        color: #fff !important;
    }
</style>
<style>
    @media (max-width: 768px) {
        .main-sidebar {
            position: fixed;
            top: 0;
            left: -260px;
            width: 260px;
            height: 100%;
            background: #1A237E;
            z-index: 1050;
            overflow-y: auto;
            transition: left 0.3s;
        }
        .main-sidebar.open {
            left: 0;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
        }
        .sidebar-overlay.active {
            display: block;
        }

        /* Menu text bold and black */
        .nav-sidebar .nav-link {
            font-weight: bold;
            color: #000 !important;
        }
        .nav-sidebar .nav-link i.nav-icon {
            color: #343a40;
        }

        /* Submenu collapsed initially */
        .nav-treeview {
            display: none;
            padding-left: 15px;
        }
        .nav-item.menu-open > .nav-treeview {
            display: block;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.main-sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');

        const overlay = document.createElement('div');
        overlay.classList.add('sidebar-overlay');
        document.body.appendChild(overlay);

        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });

        document.querySelectorAll('.nav-item.has-treeview > a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    const parent = link.parentElement;
                    parent.classList.toggle('menu-open');
                }
            });
        });
    });
</script>


