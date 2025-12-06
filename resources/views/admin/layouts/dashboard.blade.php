<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard - TheSPARK')</title>

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/sparklogo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/sparklogo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/sparklogo.png') }}">
    
    <!-- ✅ CSS Links Added Here -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    
    <!-- Page-specific CSS -->
    @stack('styles')
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')
        
        <!-- Main Content Area -->
        <div class="admin-main">
            <!-- Top Bar -->
            @include('admin.partials.topbar')
            
            <!-- Page Content -->
            <div class="admin-content">
                @hasSection('content')
                    @yield('content')
                @else
                    <!-- Default Dashboard Content -->
                    <div class="dashboard-welcome" style="padding: 2rem;">
                        <div class="welcome-header" style="margin-bottom: 2rem;">
                            <h1 style="font-size: 2rem; margin: 0 0 0.5rem 0; color: #1a1a1a;">Dashboard</h1>
                            <p style="color: #666; margin: 0;">Welcome to TheSPARK Admin Panel</p>
                        </div>

                        <!-- Stats Overview -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
                            <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                                <h3 style="font-size: 0.875rem; color: #666; margin: 0 0 0.75rem 0; font-weight: 600; text-transform: uppercase;">Total Posts</h3>
                                <p style="font-size: 2.5rem; font-weight: 700; margin: 0; color: #1a1a1a;">0</p>
                            </div>

                            <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                                <h3 style="font-size: 0.875rem; color: #666; margin: 0 0 0.75rem 0; font-weight: 600; text-transform: uppercase;">Drafts</h3>
                                <p style="font-size: 2.5rem; font-weight: 700; margin: 0; color: #1a1a1a;">0</p>
                            </div>

                            <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                                <h3 style="font-size: 0.875rem; color: #666; margin: 0 0 0.75rem 0; font-weight: 600; text-transform: uppercase;">Staff</h3>
                                <p style="font-size: 2.5rem; font-weight: 700; margin: 0; color: #1a1a1a;">0</p>
                            </div>

                            <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                                <h3 style="font-size: 0.875rem; color: #666; margin: 0 0 0.75rem 0; font-weight: 600; text-transform: uppercase;">Trash</h3>
                                <p style="font-size: 2.5rem; font-weight: 700; margin: 0; color: #1a1a1a;">0</p>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div style="margin-bottom: 3rem;">
                            <h2 style="font-size: 1.5rem; margin: 0 0 1.5rem 0; color: #1a1a1a;">Quick Actions</h2>
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                                <a href="{{ url('/admin/posts/create') }}" style="display: inline-block; padding: 1rem 1.5rem; background: #1976d2; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; text-align: center; transition: all 0.3s ease;">
                                    Write New Post
                                </a>
                                <a href="{{ url('/admin/posts') }}" style="display: inline-block; padding: 1rem 1.5rem; background: #666; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; text-align: center; transition: all 0.3s ease;">
                                    Manage Posts
                                </a>
                                <a href="{{ url('/admin/staff/create') }}" style="display: inline-block; padding: 1rem 1.5rem; background: #7b1fa2; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; text-align: center; transition: all 0.3s ease;">
                                    Add Staff
                                </a>
                                <a href="{{ url('/admin/posts/drafts') }}" style="display: inline-block; padding: 1rem 1.5rem; background: #f57c00; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; text-align: center; transition: all 0.3s ease;">
                                    View Drafts
                                </a>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div style="background: white; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);">
                            <h2 style="font-size: 1.25rem; margin: 0 0 1rem 0; color: #1a1a1a;">Recent Posts</h2>
                            <div style="text-align: center; padding: 3rem 1rem; color: #999;">
                                <p style="margin: 0 0 1rem 0;">No posts yet.</p>
                                <a href="{{ url('/admin/posts/create') }}" style="color: #1976d2; text-decoration: none; font-weight: 600;">Create your first post</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
