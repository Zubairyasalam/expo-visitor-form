@extends('layouts.app')

@section('title', 'Admin Dashboard - My India Living')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
/* CSS Overrides for App Template Structure */
body {
    display: block !important;
    background-color: #f6f8fb !important;
    min-height: 100vh !important;
    margin: 0 !important;
    padding: 0 !important;
    overflow-x: hidden !important;
}

main {
    display: block !important;
    margin: 0 !important;
    padding: 0 !important;
    width: 100% !important;
    max-width: 100% !important;
}

footer {
    display: none !important;
}

/* Global Font Overrides */
.admin-layout, 
.admin-layout input, 
.admin-layout select, 
.admin-layout button, 
.admin-layout table, 
.admin-layout th, 
.admin-layout td, 
.admin-layout a {
    font-family: 'Poppins', sans-serif !important;
}

/* Premium Layout Wrapper */
.admin-layout {
    display: flex;
    min-height: 100vh;
    background-color: #f6f8fb;
    overflow-x: hidden;
}

/* Sidebar Styling & Responsiveness */
.admin-sidebar {
    width: 260px;
    background-color: #ffffff;
    color: #5A6A85;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #e5eaf2;
    flex-shrink: 0;
    box-shadow: 4px 0 20px rgba(0, 0, 0, 0.01);
    transition: all 0.3s ease;
    position: sticky;
    top: 0;
    height: 100vh;
}

.sidebar-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e5eaf2;
    background-color: #ffffff;
    text-align: center;
}

.sidebar-logo {
    width: 100%;
    max-width: 150px;
    height: auto;
    object-fit: contain;
    display: block;
    margin: 0 auto;
}


.sidebar-nav {
    padding: 1.25rem 0.75rem;
    overflow-y: auto;
    flex-grow: 1;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0.75rem 1.2rem;
    color: #5A6A85;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 8px;
    margin-bottom: 0.25rem;
    transition: all 0.2s ease;
}

.nav-item:hover {
    color: #5d87ff;
    background-color: #f0f5ff;
}

.nav-item.active {
    color: #5d87ff;
    background-color: #ecf2ff;
}

.nav-section-title {
    padding: 1.25rem 1.2rem 0.4rem;
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    color: #7C8BA1;
}

.nav-icon {
    opacity: 0.8;
    flex-shrink: 0;
}

.nav-item:hover .nav-icon, .nav-item.active .nav-icon {
    opacity: 1;
    color: #5d87ff;
}

/* Main Dashboard Canvas */
.admin-main {
    flex-grow: 1;
    overflow-x: hidden;
    padding: 24px;
    display: flex;
    flex-direction: column;
    min-width: 0; /* Prevents flexbox children from bursting container */
}

.admin-container {
    width: 100%;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

/* Top Tab Bar Styles */
.top-tab-btn {
    background-color: transparent;
    border: none;
    padding: 0.6rem 1.5rem;
    font-weight: 700;
    font-size: 0.85rem;
    cursor: pointer;
    color: #5A6A85;
    transition: all 0.2s ease;
    border-bottom: 2px solid transparent;
}

.top-tab-btn:hover {
    color: #5d87ff;
}

.top-tab-btn.active {
    color: #5d87ff;
    border-bottom: 2px solid #5d87ff;
}

/* Table Card Layout */
.table-responsive {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
    overflow-x: auto;
    max-width: 100%;
}

.admin-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
    min-width: 900px;
}

.admin-table th {
    position: sticky;
    top: 0;
    z-index: 5;
    background-color: transparent !important;
    color: #2A3547 !important;
    font-weight: 700 !important;
    font-size: 0.825rem;
    padding: 0.8rem 1.25rem;
    text-align: left;
    border-bottom: 2px solid #e5eaf2;
    text-transform: capitalize;
    letter-spacing: 0;
}

.admin-table td {
    background-color: #ffffff;
    padding: 1.1rem 1.25rem;
    font-size: 0.85rem;
    color: #5A6A85;
    border-top: 1px solid #eaeef4;
    border-bottom: 1px solid #eaeef4;
    vertical-align: middle;
}

.admin-table td:first-child {
    border-left: 1px solid #eaeef4;
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
}

.admin-table td:last-child {
    border-right: 1px solid #eaeef4;
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
}

.admin-table tr {
    transition: all 0.2s ease;
}

.admin-table tr:hover td {
    background-color: #f8fafd;
    border-color: #d1dcff;
}

/* Status Badges */
.badge {
    padding: 6px 12px;
    font-size: 0.72rem;
    font-weight: 700;
    border-radius: 50px; /* Pill layout */
    display: inline-block;
    text-align: center;
}

.badge-yes {
    background-color: #E6FFFA !important;
    color: #1A202C !important;
    border: 1px solid #13DEB9 !important;
}

.badge-no {
    background-color: #FDF2F2 !important;
    color: #1A202C !important;
    border: 1px solid #E02424 !important;
}



/* =====================================================
   PROFESSIONAL DARK MODE — COMPLETE OVERRIDE
   Palette: bg=#0F172A, card=#1E293B, surface=#243047, 
            border=#2D3E5A, text=#E2E8F0, muted=#94A3B8
   ===================================================== */

/* === Layout === */
body.dark-mode {
    background-color: #0F172A !important;
}
body.dark-mode .admin-layout {
    background-color: #0F172A !important;
}
body.dark-mode .admin-main {
    background-color: #0F172A !important;
}

/* === Admin Header === */
body.dark-mode .admin-title {
    color: #F1F5FF !important;
}
body.dark-mode .admin-header p,
body.dark-mode .admin-header span:not(.badge) {
    color: #94A3B8 !important;
}

/* === Sidebar === */
body.dark-mode .admin-sidebar {
    background-color: #0D1526 !important;
    border-right-color: #1E2D45 !important;
}
body.dark-mode .sidebar-header {
    background-color: #0D1526 !important;
    border-bottom-color: #1E2D45 !important;
}
body.dark-mode .sidebar-logo {
    background-color: #ffffff !important;
    padding: 8px 12px !important;
    border-radius: 10px !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25) !important;
    max-width: 165px !important;
}

body.dark-mode .nav-section-title {
    color: #4F6785 !important;
}
body.dark-mode .admin-sidebar .nav-item {
    color: #7C8FAF !important;
}
body.dark-mode .admin-sidebar .nav-item:hover {
    background-color: rgba(93, 135, 255, 0.07) !important;
    color: #A5B4FC !important;
}
body.dark-mode .admin-sidebar .nav-item.active {
    background-color: rgba(93, 135, 255, 0.15) !important;
    color: #818CF8 !important;
}

/* === Top Navbar === */
body.dark-mode .top-navbar {
    border-bottom-color: #1E2D45 !important;
}
body.dark-mode .top-navbar-left h2 {
    color: #F1F5FF !important;
}
body.dark-mode .top-search {
    background-color: #1E293B !important;
    border-color: #2D3E5A !important;
    color: #E2E8F0 !important;
}
body.dark-mode .top-search::placeholder {
    color: #4A5E78 !important;
}
body.dark-mode .top-search:focus {
    background-color: #243047 !important;
    border-color: #5D87FF !important;
}
body.dark-mode .top-search-wrapper svg {
    color: #4A5E78 !important;
}
body.dark-mode .top-date-badge {
    background-color: #1E293B !important;
    border-color: #2D3E5A !important;
    color: #E2E8F0 !important;
}
body.dark-mode #theme-toggle-btn {
    background: #1E293B !important;
    border-color: #2D3E5A !important;
}
body.dark-mode .avatar-badge {
    background-color: #E2E8F0 !important;
    color: #0F172A !important;
}

/* === All White Cards (chart cards, CMS setting cards) === */
body.dark-mode [style*="background: white"],
body.dark-mode [style*="background:white"],
body.dark-mode [style*="background-color: white"],
body.dark-mode [style*="background: #ffffff"],
body.dark-mode [style*="background:#ffffff"],
body.dark-mode [style*="background-color: #ffffff"],
body.dark-mode [style*="background-color:#ffffff"],
body.dark-mode [style*="background: #fff"],
body.dark-mode [style*="background:#fff"],
body.dark-mode [style*="background-color: #fff"],
body.dark-mode [style*="background-color:#fff"] {
    background-color: #1E293B !important;
    border-color: #2D3E5A !important;
    color: #E2E8F0 !important;
}

/* === Inset panels (F8FAFC dashed borders) === */
body.dark-mode [style*="background: #F8FAFC"],
body.dark-mode [style*="background:#F8FAFC"],
body.dark-mode [style*="background-color: #F8FAFC"],
body.dark-mode [style*="background: #f8fafc"],
body.dark-mode [style*="background-color: #f8fafc"],
body.dark-mode [style*="background: #FAFBFD"],
body.dark-mode [style*="background-color: #FAFBFD"],
body.dark-mode [style*="background: #fafbfd"],
body.dark-mode [style*="background-color: #fafbfd"] {
    background-color: #152032 !important;
    border-color: #2A3E58 !important;
}

/* === Page background fallback === */
body.dark-mode [style*="background-color: #f6f8fb"],
body.dark-mode [style*="background: #f6f8fb"],
body.dark-mode [style*="background-color: #F6F8FB"] {
    background-color: #0F172A !important;
}

/* === Form inputs, textareas, selects === */
body.dark-mode input:not([type="checkbox"]):not([type="radio"]):not([class*="flatpickr"]),
body.dark-mode textarea,
body.dark-mode select,
body.dark-mode .form-control,
body.dark-mode .premium-select {
    background-color: #0F172A !important;
    color: #E2E8F0 !important;
    border-color: #2D3E5A !important;
}
body.dark-mode input::placeholder,
body.dark-mode textarea::placeholder {
    color: #3D5070 !important;
}
body.dark-mode input:focus,
body.dark-mode textarea:focus,
body.dark-mode select:focus,
body.dark-mode .form-control:focus {
    background-color: #152032 !important;
    border-color: #5D87FF !important;
    box-shadow: 0 0 0 3px rgba(93,135,255,0.12) !important;
    outline: none !important;
}

/* === Form Labels === */
body.dark-mode label,
body.dark-mode .form-label {
    color: #94A3B8 !important;
}
body.dark-mode [style*="color: #2A3547"],
body.dark-mode [style*="color:#2A3547"],
body.dark-mode [style*="color: #1b365d"],
body.dark-mode [style*="color:#1b365d"] {
    color: #E2E8F0 !important;
}
body.dark-mode [style*="color: #5A6A85"],
body.dark-mode [style*="color:#5A6A85"],
body.dark-mode [style*="color: #7C8BA1"],
body.dark-mode [style*="color:#7C8BA1"],
body.dark-mode [style*="color: #5a6a85"],
body.dark-mode [style*="color: #7c8ba1"] {
    color: #64748B !important;
}

/* === Section headings inside CMS cards === */
body.dark-mode .chart-title,
body.dark-mode h2.chart-title {
    color: #F1F5FF !important;
}
body.dark-mode [style*="color: #5D87FF"],
body.dark-mode [style*="color:#5D87FF"] {
    color: #818CF8 !important;
}

/* === Metric cards === */
body.dark-mode .metric-card {
    background-color: #1E293B !important;
    border-color: #2D3E5A !important;
}
body.dark-mode .metric-card.active-total {
    background-color: rgba(93,135,255,0.1) !important;
    border-color: #5D87FF !important;
}
body.dark-mode .metric-card.active-tn {
    background-color: rgba(255,174,31,0.1) !important;
    border-color: #FFAE1F !important;
}
body.dark-mode .metric-card.active-other {
    background-color: rgba(19,222,185,0.1) !important;
    border-color: #13DEB9 !important;
}
body.dark-mode .metric-card.active-interested {
    background-color: rgba(83,155,255,0.1) !important;
    border-color: #539BFF !important;
}

/* Overrides for inline background-colors (badges, pills, table inline blocks) */
body.dark-mode [style*="background-color: #ECF2FF"],
body.dark-mode [style*="background-color:#ECF2FF"],
body.dark-mode [style*="background: #ECF2FF"],
body.dark-mode [style*="background:#ECF2FF"] {
    background-color: rgba(93, 135, 255, 0.12) !important;
    color: #818CF8 !important;
    border-color: rgba(93, 135, 255, 0.2) !important;
}

body.dark-mode [style*="background-color: #FEF5E5"],
body.dark-mode [style*="background-color:#FEF5E5"],
body.dark-mode [style*="background: #FEF5E5"],
body.dark-mode [style*="background:#FEF5E5"],
body.dark-mode [style*="background-color: #FFF5E0"],
body.dark-mode [style*="background-color:#FFF5E0"],
body.dark-mode [style*="background: #FFF5E0"],
body.dark-mode [style*="background:#FFF5E0"] {
    background-color: rgba(255, 174, 31, 0.12) !important;
    color: #FFAE1F !important;
    border-color: rgba(255, 174, 31, 0.2) !important;
}

body.dark-mode [style*="background-color: #E6FFFA"],
body.dark-mode [style*="background-color:#E6FFFA"],
body.dark-mode [style*="background: #E6FFFA"],
body.dark-mode [style*="background:#E6FFFA"],
body.dark-mode [style*="background-color: #f2fcf9"],
body.dark-mode [style*="background: #f2fcf9"] {
    background-color: rgba(19, 222, 185, 0.12) !important;
    color: #13DEB9 !important;
    border-color: rgba(19, 222, 185, 0.2) !important;
}

body.dark-mode [style*="background-color: #EBF3FE"],
body.dark-mode [style*="background-color:#EBF3FE"],
body.dark-mode [style*="background: #EBF3FE"],
body.dark-mode [style*="background:#EBF3FE"],
body.dark-mode [style*="background-color: #e8f4ff"],
body.dark-mode [style*="background: #e8f4ff"] {
    background-color: rgba(83, 155, 255, 0.12) !important;
    color: #539BFF !important;
    border-color: rgba(83, 155, 255, 0.2) !important;
}

body.dark-mode [style*="background-color: #FDEDE8"],
body.dark-mode [style*="background-color:#FDEDE8"],
body.dark-mode [style*="background: #FDEDE8"],
body.dark-mode [style*="background:#FDEDE8"] {
    background-color: rgba(250, 137, 107, 0.12) !important;
    color: #FA896B !important;
    border-color: rgba(250, 137, 107, 0.2) !important;
}

/* Specific styling for the orange code tags like Success Page button keys */
body.dark-mode code[style*="background: #FFF4E5"],
body.dark-mode code[style*="background:#FFF4E5"],
body.dark-mode [style*="background-color: #FFF4E5"],
body.dark-mode [style*="background: #FFF4E5"] {
    background-color: rgba(255, 174, 31, 0.12) !important;
    color: #FFAE1F !important;
    border: 1px solid rgba(255, 174, 31, 0.2) !important;
}

/* Inline codes generally inside card tables */
body.dark-mode code {
    background-color: #152032 !important;
    color: #E2E8F0 !important;
    border: 1px solid #2D3E5A !important;
}

/* Ensure no blocky solid highlights behind table cell texts, divs, and spans */
body.dark-mode .admin-table td div:not(.badge),
body.dark-mode .admin-table td span:not([style*="background"]):not(.badge) {
    background-color: transparent !important;
}


/* === Table === */
body.dark-mode .admin-table th {
    color: #94A3B8 !important;
    border-bottom-color: #1E2D45 !important;
    background-color: transparent !important;
}
body.dark-mode .admin-table td {
    background-color: #1E293B !important;
    color: #CBD5E1 !important;
    border-color: #1A2740 !important;
}
body.dark-mode .admin-table tr:nth-child(even) td {
    background-color: #1A2740 !important;
}
body.dark-mode .admin-table tr:hover td {
    background-color: rgba(93, 135, 255, 0.06) !important;
}

/* === Badges === */
body.dark-mode .badge-yes {
    background-color: rgba(19, 222, 185, 0.1) !important;
    border-color: #13DEB9 !important;
    color: #13DEB9 !important;
}
body.dark-mode .badge-no {
    background-color: rgba(224, 36, 36, 0.1) !important;
    border-color: #E02424 !important;
    color: #FC8181 !important;
}

/* === Pagination === */
body.dark-mode .pagination a,
body.dark-mode .pagination span {
    background-color: #1E293B !important;
    border-color: #2D3E5A !important;
    color: #94A3B8 !important;
}
body.dark-mode .pagination .active span,
body.dark-mode .pagination [aria-current] span {
    background-color: #5D87FF !important;
    color: #FFFFFF !important;
}

/* === Section dividers === */
body.dark-mode hr {
    border-color: #1E2D45 !important;
}
body.dark-mode [style*="border-bottom: 1px solid #e5eaf2"],
body.dark-mode [style*="border-bottom: 1px solid #DFE5EF"],
body.dark-mode [style*="border-top: 1px solid #e5eaf2"],
body.dark-mode [style*="border-top: 1px solid #DFE5EF"] {
    border-color: #1E2D45 !important;
}

/* === Action buttons in table === */
body.dark-mode button[style*="background: #EBF3FE"],
body.dark-mode button[style*="background-color: #EBF3FE"],
body.dark-mode button[style*="background: #ECF2FF"],
body.dark-mode button[style*="background-color: #ECF2FF"] {
    background-color: rgba(93, 135, 255, 0.12) !important;
    color: #818CF8 !important;
    border-color: rgba(93, 135, 255, 0.2) !important;
}
body.dark-mode button[style*="background: #FDEDE8"],
body.dark-mode button[style*="background-color: #FDEDE8"] {
    background-color: rgba(224, 36, 36, 0.1) !important;
    color: #FC8181 !important;
}

/* === Bottom sidebar card === */
body.dark-mode [style*="background: linear-gradient(135deg, #ECF2FF"] {
    background: linear-gradient(135deg, #182640 0%, #0D1B33 100%) !important;
    border-color: #1E3A5A !important;
}

/* === Main footer bar === */
body.dark-mode .admin-main-footer {
    border-top-color: #1E2D45 !important;
    color: #4A5E78 !important;
    background-color: #0F172A !important;
}

/* === Toast success === */
body.dark-mode [style*="background-color: #DEF7EC"] {
    background-color: rgba(19, 222, 185, 0.08) !important;
    border-color: rgba(19, 222, 185, 0.2) !important;
    color: #13DEB9 !important;
}


/* Delete/danger small buttons in table rows */
body.dark-mode button[style*="color: #FA896B"],
body.dark-mode a[style*="color: #FA896B"] {
    color: #FC8181 !important;
}

/* === Premium Scrollbars for Dark Mode === */
body.dark-mode *::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}
body.dark-mode *::-webkit-scrollbar-track {
    background: #0F172A !important;
}
body.dark-mode *::-webkit-scrollbar-thumb {
    background: #2D3E5A !important;
    border-radius: 99px !important;
}
body.dark-mode *::-webkit-scrollbar-thumb:hover {
    background: #3D5375 !important;
}

/* Sidebar scrollbar background matching */
body.dark-mode .admin-sidebar ::-webkit-scrollbar-track {
    background: #0D1526 !important;
}
body.dark-mode .admin-sidebar ::-webkit-scrollbar-thumb {
    background: #1E2D45 !important;
}
body.dark-mode .admin-sidebar ::-webkit-scrollbar-thumb:hover {
    background: #2D3E5A !important;
}

/* Firefox scrollbar for dark mode */
body.dark-mode * {
    scrollbar-width: thin;
    scrollbar-color: #2D3E5A #0F172A;
}
body.dark-mode .admin-sidebar {
    scrollbar-color: #1E2D45 #0D1526;
}


.premium-select {
    appearance: none;
    -webkit-appearance: none;
    background-color: #ffffff;
    border: 1px solid #DFE5EF;
    border-radius: 8px;
    padding: 0.5rem 2.2rem 0.5rem 1rem;
    font-size: 0.825rem;
    font-weight: 600;
    color: #2A3547;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%235A6A85' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 12px;
    transition: all 0.2s ease;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
    display: inline-block;
}
.premium-select:focus {
    outline: none;
    border-color: #5D87FF;
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.1);
}
body.dark-mode .premium-select {
    background-color: #1A202C !important;
    color: #FFFFFF !important;
    border-color: #4A5568 !important;
}

/* Premium Layout Header */
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 0.5rem;
    flex-wrap: wrap;
}

.admin-title {
    font-size: 1.6rem;
    font-weight: 800;
    color: #2A3547;
    letter-spacing: -0.5px;
}

/* Premium Action Buttons */
.btn-secondary {
    background-color: #5d87ff !important;
    color: white !important;
    border: none !important;
    padding: 0.65rem 1.3rem !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    font-size: 0.85rem !important;
    box-shadow: 0 4px 12px rgba(93, 135, 255, 0.15) !important;
    transition: all 0.2s ease !important;
    cursor: pointer !important;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
}

.btn-secondary:hover {
    background-color: #4f73d6 !important;
    box-shadow: 0 4px 18px rgba(93, 135, 255, 0.3) !important;
}

.btn-export {
    background-color: #13deb9 !important;
    color: white !important;
    border: none !important;
    padding: 0.65rem 1.3rem !important;
    border-radius: 8px !important;
    font-weight: 600 !important;
    font-size: 0.85rem !important;
    box-shadow: 0 4px 12px rgba(19, 222, 185, 0.15) !important;
    transition: all 0.2s ease !important;
    cursor: pointer !important;
    text-decoration: none !important;
    display: inline-flex !important;
    align-items: center !important;
    gap: 6px !important;
}

.btn-export:hover {
    background-color: #0fa68b !important;
    box-shadow: 0 4px 18px rgba(19, 222, 185, 0.3) !important;
}

/* Sidebar and Canvas Responsiveness */
@media (max-width: 1024px) {
    .admin-sidebar {
        width: 76px;
    }
    .admin-sidebar .sidebar-logo, 
    .admin-sidebar .nav-item span,
    .admin-sidebar .nav-section-title,
    .sidebar-footer-wrapper {
        display: none !important;
    }
    .admin-sidebar .nav-item {
        justify-content: center;
        padding: 0.8rem;
    }
    .admin-sidebar .nav-icon {
        margin: 0 !important;
    }
}

@media (max-width: 768px) {
    .admin-layout {
        flex-direction: column;
    }
    .admin-sidebar {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid #e5eaf2;
        height: auto;
    }
    .sidebar-nav {
        display: flex;
        flex-direction: row;
        padding: 0.5rem;
        overflow-x: auto;
        justify-content: center;
    }
    .nav-item {
        margin-bottom: 0;
    }
    .admin-header {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    .admin-header div:last-child {
        justify-content: flex-start;
    }
    .admin-main {
        padding: 16px;
    }
}

/* Clickable Metric Cards styling */
.metric-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem 1.5rem 1rem 1.5rem;
    border: 1px solid #e5eaf2;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 160px;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.metric-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
}

.metric-card.active-total {
    border-color: #5D87FF !important;
    background-color: #f5f8ff !important;
    box-shadow: 0 8px 25px rgba(93, 135, 255, 0.08);
}
.metric-card.active-tn {
    border-color: #FFAE1F !important;
    background-color: #fffbf2 !important;
    box-shadow: 0 8px 25px rgba(255, 174, 31, 0.08);
}
.metric-card.active-other {
    border-color: #13DEB9 !important;
    background-color: #f2fcf9 !important;
    box-shadow: 0 8px 25px rgba(19, 222, 185, 0.08);
}
.metric-card.active-interested {
    border-color: #539BFF !important;
    background-color: #f4f9ff !important;
    box-shadow: 0 8px 25px rgba(83, 155, 255, 0.08);
}

/* Dark mode overrides for cards */
body.dark-mode .metric-card {
    background-color: #2D3748 !important;
    border-color: #4A5568 !important;
}
body.dark-mode .metric-card:hover {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}
body.dark-mode .metric-card.active-total {
    background-color: rgba(93, 135, 255, 0.1) !important;
}
body.dark-mode .metric-card.active-tn {
    background-color: rgba(255, 174, 31, 0.1) !important;
}
body.dark-mode .metric-card.active-other {
    background-color: rgba(19, 222, 185, 0.1) !important;
}
body.dark-mode .metric-card.active-interested {
    background-color: rgba(83, 155, 255, 0.1) !important;
}

/* Premium Top Navbar */
.top-navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #e5eaf2;
    flex-wrap: wrap;
    gap: 1rem;
    width: 100%;
}

.top-navbar-left h2 {
    font-size: 1.45rem;
    font-weight: 800;
    color: #2A3547;
    margin: 0;
    letter-spacing: -0.5px;
}

.top-navbar-right {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-left: auto;
}

.top-search-wrapper {
    position: relative;
    width: 220px;
}

.top-search-wrapper svg {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #7C8BA1;
    pointer-events: none;
}

.top-search {
    width: 100%;
    padding: 0.55rem 1rem 0.55rem 2.3rem !important;
    font-size: 0.825rem !important;
    font-weight: 500 !important;
    border: 1px solid #DFE5EF !important;
    border-radius: 50px !important;
    background-color: #FAFBFD !important;
    color: #2A3547 !important;
    outline: none !important;
    transition: all 0.2s ease !important;
    font-family: 'Poppins', sans-serif !important;
}

.top-search:focus {
    border-color: #5D87FF !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3px rgba(93, 135, 255, 0.1) !important;
}

.top-date-badge {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 0.55rem 1.1rem !important;
    font-size: 0.825rem !important;
    font-weight: 600 !important;
    color: #2A3547 !important;
    border: 1px solid #DFE5EF !important;
    border-radius: 50px !important;
    background-color: #ffffff !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
}

.top-date-badge:hover {
    border-color: #5D87FF !important;
}

.avatar-badge {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background-color: #0F172A;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    flex-shrink: 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

/* Dark mode overrides for top navbar */
body.dark-mode .top-navbar {
    border-bottom-color: #2D3748 !important;
}
body.dark-mode .top-navbar-left h2 {
    color: #FFFFFF !important;
}
body.dark-mode .top-search {
    background-color: #2D3748 !important;
    border-color: #4A5568 !important;
    color: #FFFFFF !important;
}
body.dark-mode .top-search:focus {
    background-color: #1A202C !important;
}
body.dark-mode .top-date-badge {
    background-color: #2D3748 !important;
    border-color: #4A5568 !important;
    color: #FFFFFF !important;
}
body.dark-mode .avatar-badge {
    background-color: #FFFFFF !important;
    color: #1A202C !important;
}
</style>

<div class="admin-layout">
    <!-- Sidebar Navigation -->
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('mil-logo-with-tagline-bg.jpg') }}?v={{ time() }}" alt="My India Living Logo" class="sidebar-logo">
        </div>
        
        <nav class="sidebar-nav">
            <a href="javascript:void(0)" id="tab-dashboard" class="nav-item active" onclick="switchTab('dashboard')">
                <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Dashboard
            </a>
            
            <div class="nav-section-title">Records</div>
            <a href="javascript:void(0)" id="tab-registrations" class="nav-item" onclick="switchTab('registrations')">
                <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Registrations
            </a>

            <div class="nav-section-title">CMS Modules</div>
            <a href="javascript:void(0)" id="tab-header-settings" class="nav-item" onclick="switchTab('header-settings')">
                <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Header
            </a>
            <a href="javascript:void(0)" id="tab-form-settings" class="nav-item" onclick="switchTab('form-settings')">
                <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/></svg>
                Form
            </a>
            <a href="javascript:void(0)" id="tab-dropdown-settings" class="nav-item" onclick="switchTab('dropdown-settings')">
                <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                Dropdowns
            </a>
            <a href="javascript:void(0)" id="tab-success-settings" class="nav-item" onclick="switchTab('success-settings')">
                <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                Success Page
            </a>
            <a href="javascript:void(0)" id="tab-footer-settings" class="nav-item" onclick="switchTab('footer-settings')">
                <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="16" width="18" height="5" rx="1"/><rect x="3" y="3" width="18" height="13" rx="2"/></svg>
                Footer
            </a>

            <div class="nav-section-title">Links</div>
            <a href="{{ url('/') }}" target="_blank" class="nav-item">
                <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                Registration Form
            </a>

            <a href="{{ $settings['crm_website'] ?? 'https://myindialiving.com' }}" target="_blank" class="nav-item">
                <svg class="nav-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                My India Living
            </a>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-main">
        <div class="admin-container">
            <!-- Top Navbar -->
            <div class="top-navbar">
                <div class="top-navbar-left">
                    <h2>Good Morning, Admin!</h2>
                </div>
                <div class="top-navbar-right">
                    <!-- Search wrapper -->
                    <div class="top-search-wrapper">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        <input id="top-search-input" class="top-search" type="text" placeholder="Search visitors..." value="{{ request('search') }}">
                    </div>

                    <!-- Date Badge -->
                    <div class="top-date-badge">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#5D87FF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <span id="top-date-display">{{ request('date_filter') ? now()->parse(request('date_filter'))->format('D, M d') : now()->format('D, M d') }}</span>
                    </div>
                    <input type="hidden" id="top-date-picker-input" value="{{ request('date_filter') }}">

                    <!-- Theme Toggle -->
                    <button id="theme-toggle-btn" style="border: 1px solid #DFE5EF; background: #FAFBFD; border-radius: 50px; padding: 4px; display: flex; align-items: center; cursor: pointer; gap: 4px; width: 62px; height: 32px; justify-content: space-between; flex-shrink: 0;" title="Toggle Theme">
                        <span id="theme-light-icon" style="width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                        </span>
                        <span id="theme-dark-icon" style="width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all 0.2s;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                        </span>
                    </button>

                    <!-- Avatar Badge -->
                    <div class="avatar-badge">AD</div>
                </div>
            </div>
    
    <!-- Toast notification -->
    @if(session('success'))
        <div style="background-color: #DEF7EC; border: 1px solid #BCF0DA; color: #03543F; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
            <span>{{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'" style="background: none; border: none; font-weight: bold; cursor: pointer; color: #03543F;">&times;</button>
        </div>
    @endif

    <!-- Admin Header -->
    <div class="admin-header">
        <div>
            <h1 class="admin-title">Visitor Submissions</h1>
            <p style="color: var(--text-secondary); margin-top: 0.25rem;">Manage and view all registered expo visitors</p>
        </div>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('visitor.index') }}" class="btn-secondary" style="display: inline-flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                Register Form
            </a>
            <a href="{{ route('admin.export') }}" class="btn-export">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
                Export CSV
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div id="view-dashboard">
        <!-- Sparkline Data Holder -->
        <div id="sparkline-data-holder" style="display: none;" data-trends='{!! json_encode($trends) !!}'></div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <!-- Card 1: Total -->
        <div id="card-total" class="metric-card" onclick="selectMetric('total')">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; width: 100%;">
                <div>
                    <p style="font-size: 0.8rem; color: #7C8BA1; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Total Visitors</p>
                    <h3 id="stat-total" style="font-size: 2.2rem; font-weight: 800; color: #2A3547; margin: 0.4rem 0 0.2rem 0;">{{ $stats['total'] }}</h3>
                    <span style="font-size: 0.75rem; color: #13DEB9; background-color: #E6FFFA; padding: 2px 8px; border-radius: 4px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        Live count
                    </span>
                </div>
                <div style="background-color: #ECF2FF; width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #5D87FF; flex-shrink: 0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 7a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
            </div>
            <div style="height: 35px; width: 100%; margin-top: 0.5rem;">
                <canvas id="sparkline-total"></canvas>
            </div>
        </div>

        <!-- Card 2: Tamil Nadu -->
        <div id="card-tn" class="metric-card" onclick="selectMetric('tn')">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; width: 100%;">
                <div>
                    <p style="font-size: 0.8rem; color: #7C8BA1; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Tamil Nadu Visitors</p>
                    <h3 id="stat-tn" style="font-size: 2.2rem; font-weight: 800; color: #2A3547; margin: 0.4rem 0 0.2rem 0;">{{ $stats['tn'] }}</h3>
                    <span style="font-size: 0.75rem; color: #FFAE1F; background-color: #FEF5E5; padding: 2px 8px; border-radius: 4px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        Live count
                    </span>
                </div>
                <div style="background-color: #FEF5E5; width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #FFAE1F; flex-shrink: 0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
            </div>
            <div style="height: 35px; width: 100%; margin-top: 0.5rem;">
                <canvas id="sparkline-tn"></canvas>
            </div>
        </div>

        <!-- Card 3: Other States -->
        <div id="card-other" class="metric-card" onclick="selectMetric('other')">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; width: 100%;">
                <div>
                    <p style="font-size: 0.8rem; color: #7C8BA1; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Other State Visitors</p>
                    <h3 id="stat-other" style="font-size: 2.2rem; font-weight: 800; color: #2A3547; margin: 0.4rem 0 0.2rem 0;">{{ $stats['other'] }}</h3>
                    <span style="font-size: 0.75rem; color: #13DEB9; background-color: #E6FFFA; padding: 2px 8px; border-radius: 4px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        Live count
                    </span>
                </div>
                <div style="background-color: #E6FFFA; width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #13DEB9; flex-shrink: 0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
            </div>
            <div style="height: 35px; width: 100%; margin-top: 0.5rem;">
                <canvas id="sparkline-other"></canvas>
            </div>
        </div>

        <!-- Card 4: Interested in Webpage -->
        <div id="card-interested" class="metric-card" onclick="selectMetric('interested')">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; width: 100%;">
                <div>
                    <p style="font-size: 0.8rem; color: #7C8BA1; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Webpage Interested</p>
                    <h3 id="stat-interested" style="font-size: 2.2rem; font-weight: 800; color: #2A3547; margin: 0.4rem 0 0.2rem 0;">{{ $stats['interested'] }}</h3>
                    <span style="font-size: 0.75rem; color: #539BFF; background-color: #EBF3FE; padding: 2px 8px; border-radius: 4px; font-weight: 600; display: inline-flex; align-items: center; gap: 4px;">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
                        Live count
                    </span>
                </div>
                <div style="background-color: #EBF3FE; width: 42px; height: 42px; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #539BFF; flex-shrink: 0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2M9 9h.01M15 9h.01"/></svg>
                </div>
            </div>
            <div style="height: 35px; width: 100%; margin-top: 0.5rem;">
                <canvas id="sparkline-interested"></canvas>
            </div>
        </div>
        </div>

        <!-- Chart Data Holder -->
        <div id="chart-data-holder" style="display: none;" data-chart='{!! json_encode($chartData) !!}'></div>

        <!-- Charts Grid mimicking given image -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Line Chart: Registrations Trend -->
            <div style="background: white; border-radius: 16px; padding: 1.5rem; border: 1px solid #e5eaf2; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);">
                <p class="chart-title" style="font-size: 0.9rem; font-weight: 700; color: #2A3547; margin-bottom: 1.25rem;">Registrations Trend (Last 7 Days)</p>
                <div style="position: relative; height: 260px; width: 100%;">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>

            <!-- Donut Chart: State Categories -->
            <div style="background: white; border-radius: 16px; padding: 1.5rem; border: 1px solid #e5eaf2; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <p class="chart-title" style="font-size: 0.9rem; font-weight: 700; color: #2A3547; margin-bottom: 1.25rem;">State Distribution</p>
                    <div style="position: relative; height: 180px; width: 100%;">
                        <canvas id="donutChart"></canvas>
                    </div>
                </div>
                <!-- Legend items with colors matching donut chart -->
                <div style="margin-top: 1rem; display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.8rem; font-weight: 600;">
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background-color: #5D87FF;"></span>
                            <span style="color: #5A6A85;">Tamil Nadu</span>
                        </div>
                        <span id="legend-tn" style="color: #2A3547;">{{ $stats['tn'] }}</span>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background-color: #FFAE1F;"></span>
                            <span style="color: #5A6A85;">Other States</span>
                        </div>
                        <span id="legend-other" style="color: #2A3547;">{{ $stats['other'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end of view-dashboard -->


    <!-- Table -->
    <div id="view-registrations" style="display: none;">
        <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Visitor Name</th>
                    <th>Mobile</th>
                    <th>WhatsApp</th>
                    <th>State</th>
                    <th>District</th>
                    <th>Business Details</th>
                    <th>Website</th>
                    <th style="white-space: nowrap;">Webpage Int.</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                @forelse($visitors as $visitor)
                    @php
                        $colors = ['#ECF2FF' => '#5D87FF', '#FEF5E5' => '#FFAE1F', '#E6FFFA' => '#13DEB9', '#EBF3FE' => '#539BFF', '#FDEDE8' => '#FA896B'];
                        $bgKeys = array_keys($colors);
                        $bg = $bgKeys[$visitor->id % count($colors)];
                        $fg = $colors[$bg];
                        $initial = strtoupper(substr(trim($visitor->name ?? 'V'), 0, 1));
                    @endphp
                    <tr>
                        <td>
                            <span style="background-color: #1A202C; color: #ffffff; padding: 4px 10px; border-radius: 6px; font-weight: 600; font-size: 0.72rem; white-space: nowrap; letter-spacing: 0.5px;">
                                MIL-{{ str_pad($visitor->id, 4, '0', STR_PAD_LEFT) }}
                            </span>
                        </td>

                        <td>
                            <div style="font-weight: 600; color: #2A3547; white-space: nowrap;">{{ $visitor->name }}</div>
                        </td>
                        <td style="font-weight: 500; color: #2A3547;">{{ $visitor->mobile_number }}</td>
                        <td style="font-weight: 500; color: #2A3547;">{{ $visitor->whatsapp_number ?? 'N/A' }}</td>
                        <td>
                            @if($visitor->state == 'Tamil Nadu')
                                <span style="background-color: #EBF3FE; color: #539BFF; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; white-space: nowrap;">Tamil Nadu</span>
                            @else
                                <span style="background-color: #FEF5E5; color: #FFAE1F; padding: 4px 8px; border-radius: 6px; font-weight: 600; font-size: 0.75rem; white-space: nowrap;">Other State</span>
                            @endif
                        </td>
                        <td>
                            @if($visitor->state == 'Tamil Nadu')
                                <span style="font-weight: 600; color: #2A3547; white-space: nowrap;">{{ $visitor->district }}</span>
                            @else
                                <span style="color: #7C8BA1; font-weight: 500; white-space: nowrap;">{{ $visitor->other_state_name ?? 'N/A' }}</span>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #2A3547;">{{ $visitor->business_name }}</div>
                            <div style="font-size: 0.75rem; color: #7C8BA1; margin-top: 2px;">{{ $visitor->business_category }} &bull; {{ $visitor->business_activity }}</div>
                        </td>
                        <td>
                            @if($visitor->has_website && $visitor->website_url)
                                <a href="{{ str_starts_with($visitor->website_url, 'http') ? $visitor->website_url : 'http://' . $visitor->website_url }}" target="_blank" style="color: #5d87ff; text-decoration: none; font-weight: 600; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 4px; white-space: nowrap;">
                                    {{ Str::limit(str_replace(['http://', 'https://', 'www.'], '', $visitor->website_url), 20) }}
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                </a>
                            @else
                                <span style="color: #A0AEC0; font-weight: 500;">—</span>
                            @endif
                        </td>
                        <td>
                            @if($visitor->interested_in_webpage)
                                <span class="badge badge-yes" style="border-radius: 50px; white-space: nowrap;">Yes</span>
                            @else
                                <span class="badge badge-no" style="border-radius: 50px; white-space: nowrap;">No</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.destroy', $visitor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this registration?')" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background-color: #FDF2F2; color: #E02424; border: 1px solid #FBD5D5; cursor: pointer; transition: all 0.2s;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 1rem; opacity: 0.5; display: block;"><circle cx="12" cy="12" r="10"/><path d="M8 12h8"/></svg>
                            No visitor records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div id="pagination-container">
        @if($visitors->hasPages())
            <div class="pagination-wrapper" style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 1rem; border-radius: var(--radius-md); box-shadow: var(--shadow-md); border: 1px solid var(--border-color);">
                <div style="font-size: 0.85rem; color: var(--text-secondary);">
                    Showing {{ $visitors->firstItem() }} to {{ $visitors->lastItem() }} of {{ $visitors->total() }} registrations
                </div>
                <div style="display: flex; gap: 0.5rem;">
                    @if($visitors->onFirstPage())
                        <span style="padding: 0.5rem 1rem; background-color: #EDF2F7; color: #A0AEC0; border-radius: var(--radius-sm); font-weight: 600; cursor: not-allowed; font-size: 0.85rem;">Previous</span>
                    @else
                        <a href="{{ $visitors->previousPageUrl() }}" class="btn-secondary" style="padding: 0.5rem 1rem; border-radius: var(--radius-sm); text-decoration: none; font-size: 0.85rem; background-color: var(--primary-blue);">Previous</a>
                    @endif

                    @if($visitors->hasMorePages())
                        <a href="{{ $visitors->nextPageUrl() }}" class="btn-secondary" style="padding: 0.5rem 1rem; border-radius: var(--radius-sm); text-decoration: none; font-size: 0.85rem; background-color: var(--primary-blue);">Next</a>
                    @else
                        <span style="padding: 0.5rem 1rem; background-color: #EDF2F7; color: #A0AEC0; border-radius: var(--radius-sm); font-weight: 600; cursor: not-allowed; font-size: 0.85rem;">Next</span>
                    @endif
                </div>
            </div>
        @endif
        </div>
    </div> <!-- end of view-registrations -->

    <!-- Global Settings View -->
    <!-- Header Settings View -->
    <div id="view-header-settings" style="display: none;">
        <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid #e5eaf2; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02); max-width: 850px; margin-bottom: 2rem;">
            <h2 class="chart-title" style="font-size: 1.25rem; font-weight: 700; color: #2A3547; margin-bottom: 1.5rem;">Header Configuration Settings</h2>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 1.5rem;">
                    <!-- Column 1: Public Registration Header -->
                    <div>
                        <h3 style="font-size: 0.95rem; font-weight: 700; color: #5D87FF; margin-top: 0; margin-bottom: 1rem; border-bottom: 1px solid #F1F3F7; padding-bottom: 0.5rem;">Public Form Details</h3>
                        
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Registration Header Title</label>
                            <input type="text" name="registration_title" value="{{ $settings['registration_title'] ?? 'Expo Registration Form' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required>
                        </div>

                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Registration Subtitle Text</label>
                            <textarea name="registration_subtitle" rows="4" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF; font-family: inherit; resize: vertical;" required>{{ $settings['registration_subtitle'] ?? 'Please fill in your details to register as a visitor' }}</textarea>
                        </div>
                    </div>

                    <!-- Column 2: CRM Global Settings -->
                    <div>
                        <h3 style="font-size: 0.95rem; font-weight: 700; color: #5D87FF; margin-top: 0; margin-bottom: 1rem; border-bottom: 1px solid #F1F3F7; padding-bottom: 0.5rem;">CRM Portal Details</h3>

                       <div class="form-group" style="margin-bottom: 1.25rem;">
                           <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">CRM Platform Title</label>
                           <input type="text" name="crm_title" value="{{ $settings['crm_title'] ?? 'Expo Desk CRM' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required>
                       </div>

                       <div class="form-group" style="margin-bottom: 1.25rem;">
                           <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">CRM Powered By Notice</label>
                           <input type="text" name="crm_powered_by" value="{{ $settings['crm_powered_by'] ?? 'Powered by My India Living Digital Platform' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required>
                       </div>

                       <div class="form-group" style="margin-bottom: 1.25rem;">
                           <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Support Website URL</label>
                           <input type="url" name="crm_website" value="{{ $settings['crm_website'] ?? 'https://myindialiving.com' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required>
                       </div>
                    </div>
                </div>

                <button type="submit" class="btn-secondary" style="border: none; padding: 0.65rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Header Settings
                </button>
            </form>
        </div>
    </div>

    <!-- Form Settings View -->
    <div id="view-form-settings" style="display: none;">
        <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid #e5eaf2; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02); max-width: 1000px; margin-bottom: 2rem;">
            <h2 class="chart-title" style="font-size: 1.25rem; font-weight: 700; color: #2A3547; margin-bottom: 0.5rem;">Form Fields Configuration</h2>
            <p style="color: #5A6A85; font-size: 0.85rem; margin-bottom: 1.5rem;">Manage, edit, or show/hide the fields of the visitor registration form.</p>

            <!-- Add New Custom Field Section -->
            <div style="background: #F8FAFC; border: 1px dashed #DFE5EF; border-radius: 12px; padding: 1.25rem; margin-bottom: 1.5rem;">
                <h4 style="font-size: 0.9rem; font-weight: 700; color: #2A3547; margin-bottom: 0.75rem;">+ Add New Custom Field</h4>
                <div style="display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
                    <div style="flex: 1; min-width: 150px;">
                        <label style="font-size: 0.75rem; font-weight: 600; color: #5A6A85; display: block; margin-bottom: 4px;">Field Key (lowercase, no spaces)</label>
                        <input type="text" id="new-field-key" placeholder="e.g. email_address" class="form-control" style="padding: 0.45rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                    </div>
                    <div style="flex: 1; min-width: 200px;">
                        <label style="font-size: 0.75rem; font-weight: 600; color: #5A6A85; display: block; margin-bottom: 4px;">Field Label</label>
                        <input type="text" id="new-field-label" placeholder="e.g. Email Address" class="form-control" style="padding: 0.45rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                    </div>
                    <div style="flex: 1; min-width: 200px;">
                        <label style="font-size: 0.75rem; font-weight: 600; color: #5A6A85; display: block; margin-bottom: 4px;">Placeholder</label>
                        <input type="text" id="new-field-placeholder" placeholder="e.g. Enter your email" class="form-control" style="padding: 0.45rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                    </div>
                    <div style="width: 100px;">
                        <label style="font-size: 0.75rem; font-weight: 600; color: #5A6A85; display: block; margin-bottom: 4px;">Required</label>
                        <select id="new-field-required" class="premium-select" style="padding: 0.45rem 2.2rem 0.45rem 0.75rem; width: 100%;">
                            <option value="1">Yes</option>
                            <option value="0" selected>No</option>
                        </select>
                    </div>
                    <button type="button" onclick="addNewFieldRow()" class="btn-secondary" style="padding: 0.5rem 1.25rem !important; border-radius: 6px !important; font-size: 0.8rem !important; margin: 0 !important; height: 38px !important;">Add Field</button>
                </div>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="admin-table" style="min-width: 100%; border-spacing: 0 4px;">
                        <thead>
                            <tr>
                                <th style="width: 15%; padding: 0.6rem 0.8rem;">Field Key</th>
                                <th style="width: 30%; padding: 0.6rem 0.8rem;">Field Label</th>
                                <th style="width: 30%; padding: 0.6rem 0.8rem;">Placeholder</th>
                                <th style="width: 10%; padding: 0.6rem 0.8rem; text-align: center;">Required</th>
                                <th style="width: 10%; padding: 0.6rem 0.8rem; text-align: center;">Status</th>
                                <th style="width: 5%; padding: 0.6rem 0.8rem; text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="fields-config-table-body">
                            @foreach($settings['fields'] ?? [] as $key => $field)
                                <tr>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <code style="background: #ECF2FF; padding: 4px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; color: #5D87FF;">{{ $key }}</code>
                                        <input type="hidden" name="fields[{{ $key }}][id]" value="{{ $field['id'] }}">
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <input type="text" name="fields[{{ $key }}][label]" value="{{ $field['label'] }}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <input type="text" name="fields[{{ $key }}][placeholder]" value="{{ $field['placeholder'] ?? '' }}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;">
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem; text-align: center;">
                                        <select name="fields[{{ $key }}][required]" class="premium-select">
                                            <option value="1" {{ ($field['required'] ?? false) ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ !($field['required'] ?? false) ? 'selected' : '' }}>No</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem; text-align: center;">
                                        <select name="fields[{{ $key }}][enabled]" class="premium-select">
                                            <option value="1" {{ ($field['enabled'] ?? true) ? 'selected' : '' }}>Show</option>
                                            <option value="0" {{ !($field['enabled'] ?? true) ? 'selected' : '' }}>Hide</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem; text-align: center;">
                                        <button type="button" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; font-weight: 700;" onclick="this.closest('tr').remove()" title="Delete Field">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 1.5rem;">
                    <button type="submit" class="btn-secondary" style="border: none; padding: 0.65rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Save Form Fields Configuration
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Dropdown Settings View -->
    <div id="view-dropdown-settings" style="display: none;">
        <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid #e5eaf2; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02); max-width: 1000px; margin-bottom: 2rem;">
            <h2 class="chart-title" style="font-size: 1.25rem; font-weight: 700; color: #2A3547; margin-bottom: 0.5rem;">Manage Form Dropdown Options</h2>
            <p style="color: #5A6A85; font-size: 0.85rem; margin-bottom: 1.5rem;">Add, edit, or delete options for the dropdown menus in the registration form.</p>

            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                    <!-- States Manager -->
                    <div>
                        <h4 style="font-size: 0.9rem; font-weight: 700; color: #5D87FF; margin-top: 0; margin-bottom: 0.75rem; display: flex; align-items: center; justify-content: space-between;">
                            <span>State Options</span>
                            <span style="font-size: 0.72rem; color: #7C8BA1; font-weight: 500;">(Edit or add below)</span>
                        </h4>
                        
                        <div id="state-list-container" style="max-height: 250px; overflow-y: auto; border: 1px solid #DFE5EF; padding: 10px; border-radius: 8px; background: #FAFBFD;">
                            @if(isset($settings['states']))
                                @foreach($settings['states'] as $stateOpt)
                                    <div class="state-item" style="display: flex; gap: 8px; margin-bottom: 8px; align-items: center;">
                                        <input type="text" name="states[]" value="{{ $stateOpt }}" class="form-control" style="flex: 1; padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;" required>
                                        <button type="button" onclick="this.parentElement.remove()" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.75rem; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.85rem;" title="Delete Option">&times;</button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div style="display: flex; gap: 8px; margin-top: 8px;">
                            <input type="text" id="new-state-input" placeholder="Add new state..." class="form-control" style="flex: 1; padding: 0.5rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                            <button type="button" onclick="addStateOption()" class="btn-secondary" style="padding: 0.5rem 1rem !important; border-radius: 6px !important; font-size: 0.75rem !important; margin: 0 !important; height: auto !important;">Add</button>
                        </div>
                    </div>

                    <!-- Categories Manager -->
                    <div>
                        <h4 style="font-size: 0.9rem; font-weight: 700; color: #5D87FF; margin-top: 0; margin-bottom: 0.75rem; display: flex; align-items: center; justify-content: space-between;">
                            <span>Business Categories</span>
                        </h4>
                        
                        <div id="category-list-container" style="max-height: 250px; overflow-y: auto; border: 1px solid #DFE5EF; padding: 10px; border-radius: 8px; background: #FAFBFD;">
                            @if(isset($settings['categories']))
                                @foreach($settings['categories'] as $cat)
                                    <div class="category-item" style="display: flex; gap: 8px; margin-bottom: 8px; align-items: center;">
                                        <input type="text" name="categories[]" value="{{ $cat }}" class="form-control" style="flex: 1; padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;" required>
                                        <button type="button" onclick="this.parentElement.remove()" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.75rem; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.85rem;" title="Delete Option">&times;</button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div style="display: flex; gap: 8px; margin-top: 8px;">
                            <input type="text" id="new-category-input" placeholder="Add new category..." class="form-control" style="flex: 1; padding: 0.5rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                            <button type="button" onclick="addCategoryOption()" class="btn-secondary" style="padding: 0.5rem 1rem !important; border-radius: 6px !important; font-size: 0.75rem !important; margin: 0 !important; height: auto !important;">Add</button>
                        </div>
                    </div>

                    <!-- Districts Manager -->
                    <div>
                        <h4 style="font-size: 0.9rem; font-weight: 700; color: #5D87FF; margin-top: 0; margin-bottom: 0.75rem; display: flex; align-items: center; justify-content: space-between;">
                            <span>Tamil Nadu Districts</span>
                        </h4>
                        
                        <div id="district-list-container" style="max-height: 250px; overflow-y: auto; border: 1px solid #DFE5EF; padding: 10px; border-radius: 8px; background: #FAFBFD;">
                            @if(isset($settings['districts']))
                                @foreach($settings['districts'] as $dist)
                                    <div class="district-item" style="display: flex; gap: 8px; margin-bottom: 8px; align-items: center;">
                                        <input type="text" name="districts[]" value="{{ $dist }}" class="form-control" style="flex: 1; padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;" required>
                                        <button type="button" onclick="this.parentElement.remove()" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.75rem; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.85rem;" title="Delete Option">&times;</button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div style="display: flex; gap: 8px; margin-top: 8px;">
                            <input type="text" id="new-district-input" placeholder="Add new district..." class="form-control" style="flex: 1; padding: 0.5rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                            <button type="button" onclick="addDistrictOption()" class="btn-secondary" style="padding: 0.5rem 1rem !important; border-radius: 6px !important; font-size: 0.75rem !important; margin: 0 !important; height: auto !important;">Add</button>
                        </div>
                    </div>

                    <!-- Submit Button Options Manager -->
                    <div>
                        <h4 style="font-size: 0.9rem; font-weight: 700; color: #5D87FF; margin-top: 0; margin-bottom: 0.75rem; display: flex; align-items: center; justify-content: space-between;">
                            <span>Submit Button Options</span>
                        </h4>
                        
                        <div id="submit-btn-list-container" style="max-height: 250px; overflow-y: auto; border: 1px solid #DFE5EF; padding: 10px; border-radius: 8px; background: #FAFBFD;">
                            @if(isset($settings['submit_button_options']))
                                @foreach($settings['submit_button_options'] as $btnOpt)
                                    <div class="submit-btn-item" style="display: flex; gap: 8px; margin-bottom: 8px; align-items: center;">
                                        <input type="radio" name="submit_button_text" value="{{ $btnOpt }}" {{ ($settings['submit_button_text'] ?? '') == $btnOpt ? 'checked' : '' }} style="cursor: pointer;" title="Select as Active Button Text">
                                        <input type="text" name="submit_button_options[]" value="{{ $btnOpt }}" class="form-control" style="flex: 1; padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;" required oninput="updateRadioValue(this)">
                                        <button type="button" onclick="this.parentElement.remove()" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.75rem; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.85rem;" title="Delete Option">&times;</button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div style="display: flex; gap: 8px; margin-top: 8px;">
                            <input type="text" id="new-submit-btn-input" placeholder="Add new button text..." class="form-control" style="flex: 1; padding: 0.5rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                            <button type="button" onclick="addSubmitButtonOption()" class="btn-secondary" style="padding: 0.5rem 1rem !important; border-radius: 6px !important; font-size: 0.75rem !important; margin: 0 !important; height: auto !important;">Add</button>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-secondary" style="border: none; padding: 0.65rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Dropdown Options
                </button>
            </form>
        </div>
    </div>
    <!-- Success Page Settings View -->
    <div id="view-success-settings" style="display: none;">
        <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid #e5eaf2; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02); max-width: 850px; margin-bottom: 2rem;">
            <h2 class="chart-title" style="font-size: 1.25rem; font-weight: 700; color: #2A3547; margin-bottom: 1.5rem;">Success Page Configuration Settings</h2>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 1.5rem;">
                    <!-- Column 1: Header Details -->
                    <div>
                        <h3 style="font-size: 0.95rem; font-weight: 700; color: #5D87FF; margin-top: 0; margin-bottom: 1rem; border-bottom: 1px solid #F1F3F7; padding-bottom: 0.5rem;">Success Message</h3>
                        
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Success Title</label>
                            <input type="text" name="success_title" value="{{ $settings['success_title'] ?? 'Registration Successful!' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Success Subtitle/Description</label>
                            <input type="text" name="success_subtitle" value="{{ $settings['success_subtitle'] ?? 'Thank you for registering. Your details have been saved.' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required>
                        </div>
                    </div>

                    <!-- Column 2: Ticket Pass Details -->
                    <div>
                        <h3 style="font-size: 0.95rem; font-weight: 700; color: #5D87FF; margin-top: 0; margin-bottom: 1rem; border-bottom: 1px solid #F1F3F7; padding-bottom: 0.5rem;">Visitor Registration Pass Card</h3>
                        
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Pass Ticket Title</label>
                            <input type="text" name="pass_title" value="{{ $settings['pass_title'] ?? 'Visitor Registration Pass' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Pass ID Prefix</label>
                            <input type="text" name="pass_prefix" value="{{ $settings['pass_prefix'] ?? 'MIL-EXPO-' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required>
                        </div>
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid #DFE5EF; margin: 2rem 0;">

                <h3 style="font-size: 1rem; font-weight: 700; color: #2A3547; margin-bottom: 0.5rem;">Pass Card Fields Configuration</h3>
                <p style="color: #5A6A85; font-size: 0.85rem; margin-bottom: 1.5rem;">Configure labels and visibility of fields shown on the printed/downloaded Visitor Registration Pass.</p>

                <!-- Add New Custom Pass Field Section -->
                <div style="background: #F8FAFC; border: 1px dashed #DFE5EF; border-radius: 12px; padding: 1.25rem; margin-bottom: 1.5rem;">
                    <h4 style="font-size: 0.85rem; font-weight: 700; color: #2A3547; margin-bottom: 0.75rem;">+ Add New Custom Pass Field</h4>
                    <div style="display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 200px;">
                            <label style="font-size: 0.75rem; font-weight: 600; color: #5A6A85; display: block; margin-bottom: 4px;">Field Key (lowercase, no spaces)</label>
                            <input type="text" id="new-pass-field-key" placeholder="e.g. email_address" class="form-control" style="padding: 0.45rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                        </div>
                        <div style="flex: 2; min-width: 250px;">
                            <label style="font-size: 0.75rem; font-weight: 600; color: #5A6A85; display: block; margin-bottom: 4px;">Field Label (on the pass)</label>
                            <input type="text" id="new-pass-field-label" placeholder="e.g. Email Address" class="form-control" style="padding: 0.45rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                        </div>
                        <button type="button" onclick="addNewPassFieldRow()" class="btn-secondary" style="padding: 0.5rem 1.25rem !important; border-radius: 6px !important; font-size: 0.8rem !important; margin: 0 !important; height: 38px !important;">Add Pass Field</button>
                    </div>
                </div>

                <div class="table-responsive" style="margin-bottom: 2rem;">
                    <table class="admin-table" style="min-width: 100%; border-spacing: 0 4px;">
                        <thead>
                            <tr>
                                <th style="width: 20%; padding: 0.6rem 0.8rem;">Field Key</th>
                                <th style="width: 50%; padding: 0.6rem 0.8rem;">Field Label on Pass</th>
                                <th style="width: 20%; padding: 0.6rem 0.8rem; text-align: center;">Status</th>
                                <th style="width: 10%; padding: 0.6rem 0.8rem; text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="pass-fields-table-body">
                            @foreach($settings['pass_fields'] ?? [] as $key => $field)
                                <tr>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <code style="background: #ECF2FF; padding: 4px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; color: #5D87FF;">{{ $key }}</code>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <input type="text" name="pass_fields[{{ $key }}][label]" value="{{ $field['label'] }}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem; text-align: center;">
                                        <select name="pass_fields[{{ $key }}][enabled]" class="premium-select">
                                            <option value="1" {{ ($field['enabled'] ?? true) ? 'selected' : '' }}>Show</option>
                                            <option value="0" {{ !($field['enabled'] ?? true) ? 'selected' : '' }}>Hide</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem; text-align: center;">
                                        <button type="button" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; font-weight: 700;" onclick="this.closest('tr').remove()" title="Delete Pass Field">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr style="border: 0; border-top: 1px solid #DFE5EF; margin: 2rem 0;">

                <h3 style="font-size: 1rem; font-weight: 700; color: #2A3547; margin-bottom: 0.5rem;">Action Buttons Configuration</h3>
                <p style="color: #5A6A85; font-size: 0.85rem; margin-bottom: 1.5rem;">Configure the labels and visibility of the action buttons at the bottom of the success page.</p>

                <div class="table-responsive" style="margin-bottom: 2rem;">
                    <table class="admin-table" style="min-width: 100%; border-spacing: 0 4px;">
                        <thead>
                            <tr>
                                <th style="width: 25%; padding: 0.6rem 0.8rem;">Button Key</th>
                                <th style="width: 50%; padding: 0.6rem 0.8rem;">Button Label</th>
                                <th style="width: 25%; padding: 0.6rem 0.8rem; text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settings['success_buttons'] ?? [] as $key => $btn)
                                <tr>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <code style="background: #FFF4E5; padding: 4px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; color: #FFAE1F;">{{ $key }}</code>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <input type="text" name="success_buttons[{{ $key }}][label]" value="{{ $btn['label'] }}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem; text-align: center;">
                                        <select name="success_buttons[{{ $key }}][enabled]" class="premium-select">
                                            <option value="1" {{ ($btn['enabled'] ?? true) ? 'selected' : '' }}>Show</option>
                                            <option value="0" {{ !($btn['enabled'] ?? true) ? 'selected' : '' }}>Hide</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn-secondary" style="border: none; padding: 0.65rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Success Page Settings
                </button>
            </form>
        </div>
    </div>

    <!-- Footer Settings View -->
    <div id="view-footer-settings" style="display: none;">
        <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid #e5eaf2; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02); max-width: 850px; margin-bottom: 2rem;">
            <h2 class="chart-title" style="font-size: 1.25rem; font-weight: 700; color: #2A3547; margin-bottom: 1.5rem;">Footer Configuration Settings</h2>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
                    <!-- Column 1: Copyright Information -->
                    <div>
                        <h3 style="font-size: 0.95rem; font-weight: 700; color: #5D87FF; margin-top: 0; margin-bottom: 1rem; border-bottom: 1px solid #F1F3F7; padding-bottom: 0.5rem;">Copyright Settings</h3>
                        
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Copyright Year</label>
                            <input type="text" name="footer_year" value="{{ $settings['footer_year'] ?? '2026' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required placeholder="e.g. 2026">
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Copyright Text / Owner</label>
                            <input type="text" name="footer_copyright_text" value="{{ $settings['footer_copyright_text'] ?? 'My India Living' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required placeholder="e.g. My India Living">
                        </div>
                    </div>

                    <!-- Column 2: Additional Footer Details -->
                    <div>
                        <h3 style="font-size: 0.95rem; font-weight: 700; color: #5D87FF; margin-top: 0; margin-bottom: 1rem; border-bottom: 1px solid #F1F3F7; padding-bottom: 0.5rem;">Links & Subtitle</h3>
                        
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Copyright Link URL</label>
                            <input type="url" name="footer_copyright_link" value="{{ $settings['footer_copyright_link'] ?? 'https://myindialiving.com' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required placeholder="e.g. https://myindialiving.com">
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 1.25rem;">
                            <label class="form-label" style="font-weight: 600; font-size: 0.85rem; color: #5A6A85; margin-bottom: 0.5rem; display: block;">Footer Subtitle / Bottom Text</label>
                            <input type="text" name="footer_subtitle" value="{{ $settings['footer_subtitle'] ?? 'Expo Visitor Registration System' }}" class="form-control" style="width: 100%; padding: 0.65rem 1rem; border-radius: 8px; border: 1px solid #DFE5EF;" required placeholder="e.g. Expo Visitor Registration System">
                        </div>
                    </div>
                </div>
                <hr style="border: 0; border-top: 1px solid #DFE5EF; margin: 2rem 0;">

                <h3 style="font-size: 1.1rem; font-weight: 700; color: #2A3547; margin-bottom: 0.5rem;">Footer Text Lines</h3>
                <p style="color: #5A6A85; font-size: 0.85rem; margin-bottom: 1.5rem;">Configure the text lines appearing at the bottom of the footer (e.g. copyright notices, registration system info). You can add new lines, delete lines, and edit their text/link dynamically.</p>

                <!-- Add New Footer Text Line Section -->
                <div style="background: #F8FAFC; border: 1px dashed #DFE5EF; border-radius: 12px; padding: 1.25rem; margin-bottom: 1.5rem;">
                    <h4 style="font-size: 0.85rem; font-weight: 700; color: #2A3547; margin-bottom: 0.75rem;">+ Add New Footer Text Line</h4>
                    <div style="display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
                        <div style="flex: 2; min-width: 250px;">
                            <label style="font-size: 0.75rem; font-weight: 600; color: #5A6A85; display: block; margin-bottom: 4px;">Line Text</label>
                            <input type="text" id="new-footer-line-text" placeholder="e.g. © 2026 My India Living. All rights reserved." class="form-control" style="padding: 0.45rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                        </div>
                        <div style="flex: 1; min-width: 200px;">
                            <label style="font-size: 0.75rem; font-weight: 600; color: #5A6A85; display: block; margin-bottom: 4px;">Optional Link URL</label>
                            <input type="text" id="new-footer-line-link" placeholder="e.g. https://myindialiving.com" class="form-control" style="padding: 0.45rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                        </div>
                        <button type="button" onclick="addNewFooterLineRow()" class="btn-secondary" style="padding: 0.5rem 1.25rem !important; border-radius: 6px !important; font-size: 0.8rem !important; margin: 0 !important; height: 38px !important;">Add Line</button>
                    </div>
                </div>

                <div class="table-responsive" style="margin-bottom: 2rem;">
                    <table class="admin-table" style="min-width: 100%; border-spacing: 0 4px;">
                        <thead>
                            <tr>
                                <th style="width: 50%; padding: 0.6rem 0.8rem;">Line Text</th>
                                <th style="width: 40%; padding: 0.6rem 0.8rem;">Link URL (Optional)</th>
                                <th style="width: 10%; padding: 0.6rem 0.8rem; text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="footer-text-lines-table-body">
                            @foreach($settings['footer_text_lines'] ?? [] as $index => $line)
                                <tr>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <input type="text" name="footer_text_lines[{{ $index }}][text]" value="{{ $line['text'] }}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <input type="text" name="footer_text_lines[{{ $index }}][link_url]" value="{{ $line['link_url'] ?? '' }}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;">
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem; text-align: center;">
                                        <button type="button" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; font-weight: 700;" onclick="this.closest('tr').remove()" title="Delete Line">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <hr style="border: 0; border-top: 1px solid #DFE5EF; margin: 2rem 0;">

                <h3 style="font-size: 1.1rem; font-weight: 700; color: #2A3547; margin-bottom: 0.5rem;">Footer Quick Links</h3>
                <p style="color: #5A6A85; font-size: 0.85rem; margin-bottom: 1.5rem;">Add, edit, or delete the links that appear in the footer of the registration page.</p>

                <!-- Add New Footer Link Section -->
                <div style="background: #F8FAFC; border: 1px dashed #DFE5EF; border-radius: 12px; padding: 1.25rem; margin-bottom: 1.5rem;">
                    <h4 style="font-size: 0.85rem; font-weight: 700; color: #2A3547; margin-bottom: 0.75rem;">+ Add New Footer Link</h4>
                    <div style="display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 200px;">
                            <label style="font-size: 0.75rem; font-weight: 600; color: #5A6A85; display: block; margin-bottom: 4px;">Link Label</label>
                            <input type="text" id="new-footer-link-label" placeholder="e.g. Privacy Policy" class="form-control" style="padding: 0.45rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                        </div>
                        <div style="flex: 2; min-width: 250px;">
                            <label style="font-size: 0.75rem; font-weight: 600; color: #5A6A85; display: block; margin-bottom: 4px;">Link URL</label>
                            <input type="text" id="new-footer-link-url" placeholder="e.g. https://myindialiving.com/privacy" class="form-control" style="padding: 0.45rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;">
                        </div>
                        <button type="button" onclick="addNewFooterLinkRow()" class="btn-secondary" style="padding: 0.5rem 1.25rem !important; border-radius: 6px !important; font-size: 0.8rem !important; margin: 0 !important; height: 38px !important;">Add Link</button>
                    </div>
                </div>

                <div class="table-responsive" style="margin-bottom: 2rem;">
                    <table class="admin-table" style="min-width: 100%; border-spacing: 0 4px;">
                        <thead>
                            <tr>
                                <th style="width: 40%; padding: 0.6rem 0.8rem;">Link Label</th>
                                <th style="width: 40%; padding: 0.6rem 0.8rem;">Link URL</th>
                                <th style="width: 12%; padding: 0.6rem 0.8rem; text-align: center;">Status</th>
                                <th style="width: 8%; padding: 0.6rem 0.8rem; text-align: center;">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="footer-links-table-body">
                            @foreach($settings['footer_links'] ?? [] as $index => $link)
                                <tr>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <input type="text" name="footer_links[{{ $index }}][label]" value="{{ $link['label'] }}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem;">
                                        <input type="text" name="footer_links[{{ $index }}][url]" value="{{ $link['url'] }}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem; text-align: center;">
                                        <select name="footer_links[{{ $index }}][enabled]" class="premium-select">
                                            <option value="1" {{ ($link['enabled'] ?? true) ? 'selected' : '' }}>Show</option>
                                            <option value="0" {{ !($link['enabled'] ?? true) ? 'selected' : '' }}>Hide</option>
                                        </select>
                                    </td>
                                    <td style="padding: 0.6rem 0.8rem; text-align: center;">
                                        <button type="button" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; font-weight: 700;" onclick="this.closest('tr').remove()" title="Delete Link">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button type="submit" class="btn-secondary" style="border: none; padding: 0.65rem 1.5rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Save Footer Settings
                </button>
            </form>
        </div>
    </div>

        <!-- Main Content Footer -->
        <footer class="admin-main-footer" style="padding: 1.5rem; text-align: center; color: #7C8BA1; border-top: 1px solid #e5eaf2; margin-top: auto; font-size: 0.8rem; background-color: transparent;">
            @if(isset($settings['footer_text_lines']) && count($settings['footer_text_lines']) > 0)
                @foreach($settings['footer_text_lines'] as $line)
                    <p style="margin: 4px 0;">
                        @if(!empty($line['link_url']))
                            <a href="{{ $line['link_url'] }}" target="_blank" style="color: #5d87ff; text-decoration: none; font-weight: 600;">{{ $line['text'] }}</a>
                        @else
                            {{ $line['text'] }}
                        @endif
                    </p>
                @endforeach
            @else
                <p style="margin: 0;">&copy; {{ $settings['footer_year'] ?? date('Y') }} <a href="{{ $settings['footer_copyright_link'] ?? 'https://myindialiving.com' }}" target="_blank" style="color: #5d87ff; text-decoration: none; font-weight: 600;">{{ $settings['footer_copyright_text'] ?? 'My India Living' }}</a>. All rights reserved.</p>
                <p style="margin: 4px 0 0 0; font-size: 0.75rem; opacity: 0.7;">{{ $settings['footer_subtitle'] ?? 'Expo Visitor Registration System' }}</p>
            @endif
        </footer>
    </div>
    </div> <!-- end of admin-container -->
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
window.switchTab = function(tabId) {
    const tabs = ['dashboard', 'registrations', 'header-settings', 'form-settings', 'dropdown-settings', 'success-settings', 'footer-settings'];
    
    tabs.forEach(t => {
        const view = document.getElementById('view-' + t);
        const btn = document.getElementById('tab-' + t);
        if (view) {
            view.style.display = (t === tabId) ? 'block' : 'none';
        }
        if (btn) {
            if (t === tabId) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        }
    });
    
    // Hide the main header on CMS module tabs
    const adminHeader = document.querySelector('.admin-header');
    if (adminHeader) {
        adminHeader.style.display = (tabId === 'form-settings' || tabId === 'header-settings' || tabId === 'dropdown-settings' || tabId === 'success-settings' || tabId === 'footer-settings') ? 'none' : 'flex';
    }

    localStorage.setItem('admin_active_tab', tabId);
}

window.activeMetric = 'total';

window.selectMetric = function(metric) {
    window.activeMetric = metric;
    
    // 1. Update active states on cards
    const cardIds = ['total', 'tn', 'other', 'interested'];
    cardIds.forEach(id => {
        const card = document.getElementById('card-' + id);
        if (card) {
            card.classList.remove('active-total', 'active-tn', 'active-other', 'active-interested');
            if (id === metric) {
                card.classList.add('active-' + id);
            }
        }
    });
    
    // 2. Fetch corresponding trend data from sparkline-data-holder
    const sparkHolder = document.getElementById('sparkline-data-holder');
    const trendsData = sparkHolder ? JSON.parse(sparkHolder.getAttribute('data-trends')) : null;
    if (!trendsData) return;
    
    let newData = [];
    let label = '';
    let borderColor = '#5D87FF';
    let bgColor = 'rgba(93, 135, 255, 0.05)';
    
    switch(metric) {
        case 'total':
            newData = trendsData.total;
            label = 'Total Visitors';
            borderColor = '#5D87FF';
            bgColor = 'rgba(93, 135, 255, 0.05)';
            break;
        case 'tn':
            newData = trendsData.tn;
            label = 'Tamil Nadu Visitors';
            borderColor = '#FFAE1F';
            bgColor = 'rgba(255, 174, 31, 0.05)';
            break;
        case 'other':
            newData = trendsData.other;
            label = 'Other State Visitors';
            borderColor = '#13DEB9';
            bgColor = 'rgba(19, 222, 185, 0.05)';
            break;
        case 'interested':
            newData = trendsData.interested;
            label = 'Webpage Interested';
            borderColor = '#539BFF';
            bgColor = 'rgba(83, 155, 255, 0.05)';
            break;
    }
    
    // 3. Update main line chart
    if (window.lineChart) {
        window.lineChart.data.datasets[0].data = newData;
        window.lineChart.data.datasets[0].label = label;
        window.lineChart.data.datasets[0].borderColor = borderColor;
        window.lineChart.data.datasets[0].backgroundColor = bgColor;
        window.lineChart.data.datasets[0].pointBackgroundColor = borderColor;
        window.lineChart.update();
        
        // Also update chart title element
        const chartTitle = document.querySelector('#lineChart').closest('div').parentElement.querySelector('.chart-title');
        if (chartTitle) {
            let metricTitle = 'Total Registrations';
            if (metric === 'tn') metricTitle = 'Tamil Nadu Registrations';
            else if (metric === 'other') metricTitle = 'Other State Registrations';
            else if (metric === 'interested') metricTitle = 'Webpage Interest';
            chartTitle.textContent = metricTitle + ' Trend (Last 7 Days)';
        }
    }
}


document.addEventListener('DOMContentLoaded', function() {
    // Restore tab state from localStorage
    const savedTab = localStorage.getItem('admin_active_tab') || 'dashboard';
    window.switchTab(savedTab);

    // Set initial active metric card highlight
    const defaultCard = document.getElementById('card-total');
    if (defaultCard) {
        defaultCard.classList.add('active-total');
    }

    // --- Theme Switcher Logic ---
    const themeBtn = document.getElementById('theme-toggle-btn');
    const darkIcon = document.getElementById('theme-dark-icon');
    const lightIcon = document.getElementById('theme-light-icon');
    
    function setTheme(theme) {
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
            if (darkIcon && lightIcon) {
                darkIcon.style.backgroundColor = '#FFAE1F';
                darkIcon.style.color = '#1A202C';
                darkIcon.style.boxShadow = '0 2px 6px rgba(255,174,31,0.4)';
                
                lightIcon.style.backgroundColor = 'transparent';
                lightIcon.style.color = '#64748B';
                lightIcon.style.boxShadow = 'none';
            }
            if (themeBtn) {
                themeBtn.style.background = '#1E293B';
                themeBtn.style.borderColor = '#3A4A6B';
            }
        } else {
            document.body.classList.remove('dark-mode');
            if (darkIcon && lightIcon) {
                darkIcon.style.backgroundColor = 'transparent';
                darkIcon.style.color = '#94A3B8';
                darkIcon.style.boxShadow = 'none';
                
                lightIcon.style.backgroundColor = '#5D87FF';
                lightIcon.style.color = '#ffffff';
                lightIcon.style.boxShadow = '0 2px 6px rgba(93,135,255,0.4)';
            }
            if (themeBtn) {
                themeBtn.style.background = '#FAFBFD';
                themeBtn.style.borderColor = '#DFE5EF';
            }
        }
        localStorage.setItem('admin_theme', theme);
    }
    
    if (themeBtn) {
        themeBtn.addEventListener('click', function() {
            const isDark = document.body.classList.contains('dark-mode');
            setTheme(isDark ? 'light' : 'dark');
        });
    }
    
    const savedTheme = localStorage.getItem('admin_theme') || 'light';
    setTheme(savedTheme);


    // --- Live Search & Date Picker AJAX query updating ---
    const searchInput = document.getElementById('top-search-input');
    const dateInput = document.getElementById('top-date-picker-input');
    const dateDisplay = document.getElementById('top-date-display');
    
    let searchDebounceTimer;
    
    function triggerAjaxUpdate() {
        const url = new URL(window.location.href);
        if (searchInput.value) {
            url.searchParams.set('search', searchInput.value);
        } else {
            url.searchParams.delete('search');
        }
        
        if (dateInput.value) {
            url.searchParams.set('date_filter', dateInput.value);
            
            const dateObj = new Date(dateInput.value);
            const options = { weekday: 'short', month: 'short', day: 'numeric' };
            dateDisplay.innerText = dateObj.toLocaleDateString('en-US', options);
        } else {
            url.searchParams.delete('date_filter');
            dateDisplay.innerText = "{{ now()->format('D, M d') }}";
        }
        
        window.history.pushState({}, '', url);
        
        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                
                const oldTbody = document.querySelector('table.admin-table tbody');
                const newTbody = doc.querySelector('table.admin-table tbody');
                if (oldTbody && newTbody) {
                    oldTbody.innerHTML = newTbody.innerHTML;
                }
                
                const statIds = ['stat-total', 'stat-tn', 'stat-other', 'stat-interested'];
                statIds.forEach(id => {
                    const oldEl = document.getElementById(id);
                    const newEl = doc.getElementById(id);
                    if (oldEl && newEl) {
                        oldEl.textContent = newEl.textContent;
                    }
                });
                
                const newChartHolder = doc.getElementById('chart-data-holder');
                if (newChartHolder && window.lineChart && window.donutChart) {
                    const newChartData = JSON.parse(newChartHolder.getAttribute('data-chart'));
                    const newTn = parseInt(doc.getElementById('stat-tn').innerText);
                    const newOther = parseInt(doc.getElementById('stat-other').innerText);

                    window.lineChart.data.labels = newChartData.map(item => item.label);
                    const newSparkHolder = doc.getElementById('sparkline-data-holder');
                    const newTrends = newSparkHolder ? JSON.parse(newSparkHolder.getAttribute('data-trends')) : null;
                    if (newTrends && newTrends[window.activeMetric]) {
                        window.lineChart.data.datasets[0].data = newTrends[window.activeMetric];
                    } else {
                        window.lineChart.data.datasets[0].data = newChartData.map(item => item.value);
                    }
                    window.lineChart.update();

                    window.donutChart.data.datasets[0].data = [newTn, newOther];
                    window.donutChart.update();

                    document.getElementById('legend-tn').innerText = newTn;
                    document.getElementById('legend-other').innerText = newOther;
                }

                const newSparkHolder = doc.getElementById('sparkline-data-holder');
                if (newSparkHolder && window.sparkCharts) {
                    const newTrends = JSON.parse(newSparkHolder.getAttribute('data-trends'));
                    window.sparkCharts.total.data.datasets[0].data = newTrends.total;
                    window.sparkCharts.total.update();
                    window.sparkCharts.tn.data.datasets[0].data = newTrends.tn;
                    window.sparkCharts.tn.update();
                    window.sparkCharts.other.data.datasets[0].data = newTrends.other;
                    window.sparkCharts.other.update();
                    window.sparkCharts.interested.data.datasets[0].data = newTrends.interested;
                    window.sparkCharts.interested.update();
                }
                
                const oldPag = document.getElementById('pagination-container');
                const newPag = doc.getElementById('pagination-container');
                if (oldPag && newPag) {
                    oldPag.innerHTML = newPag.innerHTML;
                }
            });
    }
    
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchDebounceTimer);
            searchDebounceTimer = setTimeout(triggerAjaxUpdate, 300);
        });
    }
    
    // Bind Flatpickr to the date badge container
    flatpickr(".top-date-badge", {
        defaultDate: dateInput && dateInput.value ? dateInput.value : 'today',
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr) {
            if (dateInput) {
                dateInput.value = dateStr;
                triggerAjaxUpdate();
            }
        }
    });

    // Initial chart data from DOM holder
    const chartHolder = document.getElementById('chart-data-holder');
    let chartData = chartHolder ? JSON.parse(chartHolder.getAttribute('data-chart')) : [];
    
    const chartLabels = chartData.map(item => item.label);
    const chartValues = chartData.map(item => item.value);
    
    const statTn = parseInt(document.getElementById('stat-tn').innerText);
    const statOther = parseInt(document.getElementById('stat-other').innerText);

    // 1. Line Chart: Registrations Trend
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    const lineChart = new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Registrations',
                data: chartValues,
                borderColor: '#5D87FF',
                backgroundColor: 'rgba(93, 135, 255, 0.05)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#5D87FF',
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#eaeef4' },
                    ticks: { font: { family: 'Poppins', size: 10 }, color: '#7C8BA1', stepSize: 1 }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Poppins', size: 10 }, color: '#7C8BA1' }
                }
            }
        }
    });

    // 2. Donut Chart: State Categories
    const ctxDonut = document.getElementById('donutChart').getContext('2d');
    const donutChart = new Chart(ctxDonut, {
        type: 'doughnut',
        data: {
            labels: ['Tamil Nadu', 'Other States'],
            datasets: [{
                data: [statTn, statOther],
                backgroundColor: ['#5D87FF', '#FFAE1F'],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            cutout: '75%'
        }
    });

    // 3. Sparklines
    const sparkHolder = document.getElementById('sparkline-data-holder');
    const trendsData = sparkHolder ? JSON.parse(sparkHolder.getAttribute('data-trends')) : {
        total: [0,0,0,0,0,0,0],
        tn: [0,0,0,0,0,0,0],
        other: [0,0,0,0,0,0,0],
        interested: [0,0,0,0,0,0,0]
    };

    const sparkOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false }, tooltip: { enabled: false } },
        scales: { x: { display: false }, y: { display: false } },
        elements: { point: { radius: 0 } }
    };

    const sparkTotal = new Chart(document.getElementById('sparkline-total').getContext('2d'), {
        type: 'line',
        data: {
            labels: [1,2,3,4,5,6,7],
            datasets: [{
                data: trendsData.total,
                borderColor: '#5D87FF',
                borderWidth: 2,
                tension: 0.4,
                fill: false
            }]
        },
        options: sparkOptions
    });

    const sparkTn = new Chart(document.getElementById('sparkline-tn').getContext('2d'), {
        type: 'line',
        data: {
            labels: [1,2,3,4,5,6,7],
            datasets: [{
                data: trendsData.tn,
                borderColor: '#FFAE1F',
                borderWidth: 2,
                tension: 0.4,
                fill: false
            }]
        },
        options: sparkOptions
    });

    const sparkOther = new Chart(document.getElementById('sparkline-other').getContext('2d'), {
        type: 'line',
        data: {
            labels: [1,2,3,4,5,6,7],
            datasets: [{
                data: trendsData.other,
                borderColor: '#13DEB9',
                borderWidth: 2,
                tension: 0.4,
                fill: false
            }]
        },
        options: sparkOptions
    });

    const sparkInterested = new Chart(document.getElementById('sparkline-interested').getContext('2d'), {
        type: 'line',
        data: {
            labels: [1,2,3,4,5,6,7],
            datasets: [{
                data: trendsData.interested,
                borderColor: '#539BFF',
                borderWidth: 2,
                tension: 0.4,
                fill: false
            }]
        },
        options: sparkOptions
    });

    // Save references globally to update them inside interval
    window.lineChart = lineChart;
    window.donutChart = donutChart;
    window.sparkCharts = {
        total: sparkTotal,
        tn: sparkTn,
        other: sparkOther,
        interested: sparkInterested
    };

    // Poll the server for new registrations every 3 seconds
    setInterval(function() {
        const url = new URL(window.location.href);

        fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                // 1. Update table body
                const oldTbody = document.querySelector('table.admin-table tbody');
                const newTbody = doc.querySelector('table.admin-table tbody');
                if (oldTbody && newTbody) {
                    oldTbody.innerHTML = newTbody.innerHTML;
                }

                // 2. Update stats cards
                const statIds = ['stat-total', 'stat-tn', 'stat-other', 'stat-interested'];
                statIds.forEach(id => {
                    const oldEl = document.getElementById(id);
                    const newEl = doc.getElementById(id);
                    if (oldEl && newEl && oldEl.textContent !== newEl.textContent) {
                        oldEl.textContent = newEl.textContent;
                        
                        // Add a scale micro-animation on update
                        oldEl.style.transform = 'scale(1.2)';
                        oldEl.style.transition = 'transform 0.2s ease';
                        setTimeout(() => {
                            oldEl.style.transform = 'scale(1)';
                        }, 200);
                    }
                });

                // 3. Update Chart datasets
                const newChartHolder = doc.getElementById('chart-data-holder');
                if (newChartHolder && window.lineChart && window.donutChart) {
                    const newChartData = JSON.parse(newChartHolder.getAttribute('data-chart'));
                    const newTn = parseInt(doc.getElementById('stat-tn').innerText);
                    const newOther = parseInt(doc.getElementById('stat-other').innerText);

                    // Update Line Chart
                    window.lineChart.data.labels = newChartData.map(item => item.label);
                    const newSparkHolder = doc.getElementById('sparkline-data-holder');
                    const newTrends = newSparkHolder ? JSON.parse(newSparkHolder.getAttribute('data-trends')) : null;
                    if (newTrends && newTrends[window.activeMetric]) {
                        window.lineChart.data.datasets[0].data = newTrends[window.activeMetric];
                    } else {
                        window.lineChart.data.datasets[0].data = newChartData.map(item => item.value);
                    }
                    window.lineChart.update('none'); // silent update

                    // Update Donut Chart
                    window.donutChart.data.datasets[0].data = [newTn, newOther];
                    window.donutChart.update('none');

                    // Update legend values
                    document.getElementById('legend-tn').innerText = newTn;
                    document.getElementById('legend-other').innerText = newOther;
                }

                // Update Sparklines
                const newSparkHolder = doc.getElementById('sparkline-data-holder');
                if (newSparkHolder && window.sparkCharts) {
                    const newTrends = JSON.parse(newSparkHolder.getAttribute('data-trends'));
                    
                    window.sparkCharts.total.data.datasets[0].data = newTrends.total;
                    window.sparkCharts.total.update('none');

                    window.sparkCharts.tn.data.datasets[0].data = newTrends.tn;
                    window.sparkCharts.tn.update('none');

                    window.sparkCharts.other.data.datasets[0].data = newTrends.other;
                    window.sparkCharts.other.update('none');

                    window.sparkCharts.interested.data.datasets[0].data = newTrends.interested;
                    window.sparkCharts.interested.update('none');
                }

                // 4. Update pagination
                const oldPag = document.getElementById('pagination-container');
                const newPag = doc.getElementById('pagination-container');
                if (oldPag && newPag) {
                    oldPag.innerHTML = newPag.innerHTML;
                }
            })
            .catch(err => console.error('Error auto-refreshing admin dashboard:', err));
    }, 3000);
});

window.addStateOption = function() {
    const input = document.getElementById('new-state-input');
    const val = input.value.trim();
    if (!val) return;
    
    const container = document.getElementById('state-list-container');
    const div = document.createElement('div');
    div.className = 'state-item';
    div.style.display = 'flex';
    div.style.gap = '8px';
    div.style.marginBottom = '8px';
    div.style.alignItems = 'center';
    div.innerHTML = `
        <input type="text" name="states[]" value="${val}" class="form-control" style="flex: 1; padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;" required>
        <button type="button" onclick="this.parentElement.remove()" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.75rem; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.85rem;" title="Delete Option">&times;</button>
    `;
    container.appendChild(div);
    input.value = '';
    container.scrollTop = container.scrollHeight;
}

window.addCategoryOption = function() {
    const input = document.getElementById('new-category-input');
    const val = input.value.trim();
    if (!val) return;
    
    const container = document.getElementById('category-list-container');
    const div = document.createElement('div');
    div.className = 'category-item';
    div.style.display = 'flex';
    div.style.gap = '8px';
    div.style.marginBottom = '8px';
    div.style.alignItems = 'center';
    div.innerHTML = `
        <input type="text" name="categories[]" value="${val}" class="form-control" style="flex: 1; padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;" required>
        <button type="button" onclick="this.parentElement.remove()" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.75rem; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.85rem;" title="Delete Option">&times;</button>
    `;
    container.appendChild(div);
    input.value = '';
    container.scrollTop = container.scrollHeight;
}

window.addDistrictOption = function() {
    const input = document.getElementById('new-district-input');
    const val = input.value.trim();
    if (!val) return;
    
    const container = document.getElementById('district-list-container');
    const div = document.createElement('div');
    div.className = 'district-item';
    div.style.display = 'flex';
    div.style.gap = '8px';
    div.style.marginBottom = '8px';
    div.style.alignItems = 'center';
    div.innerHTML = `
        <input type="text" name="districts[]" value="${val}" class="form-control" style="flex: 1; padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;" required>
        <button type="button" onclick="this.parentElement.remove()" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.75rem; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.85rem;" title="Delete Option">&times;</button>
    `;
    container.appendChild(div);
    input.value = '';
    container.scrollTop = container.scrollHeight;
}

window.addSubmitButtonOption = function() {
    const input = document.getElementById('new-submit-btn-input');
    const val = input.value.trim();
    if (!val) return;
    
    const container = document.getElementById('submit-btn-list-container');
    const div = document.createElement('div');
    div.className = 'submit-btn-item';
    div.style.display = 'flex';
    div.style.gap = '8px';
    div.style.marginBottom = '8px';
    div.style.alignItems = 'center';
    div.innerHTML = `
        <input type="radio" name="submit_button_text" value="${val}" style="cursor: pointer;" title="Select as Active Button Text">
        <input type="text" name="submit_button_options[]" value="${val}" class="form-control" style="flex: 1; padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.85rem;" required oninput="updateRadioValue(this)">
        <button type="button" onclick="this.parentElement.remove()" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.75rem; border-radius: 6px; cursor: pointer; font-weight: bold; font-size: 0.85rem;" title="Delete Option">&times;</button>
    `;
    container.appendChild(div);
    input.value = '';
    container.scrollTop = container.scrollHeight;
}

window.updateRadioValue = function(input) {
    const radio = input.parentElement.querySelector('input[type="radio"]');
    if (radio) {
        radio.value = input.value;
    }
}

window.addNewFieldRow = function() {
    const keyInput = document.getElementById('new-field-key');
    const labelInput = document.getElementById('new-field-label');
    const placeholderInput = document.getElementById('new-field-placeholder');
    const requiredInput = document.getElementById('new-field-required');
    
    // Clean and validate key
    const rawKey = keyInput.value.trim();
    const key = rawKey.toLowerCase().replace(/[^a-z0-9_]/g, '');
    const label = labelInput.value.trim();
    const placeholder = placeholderInput.value.trim();
    const required = requiredInput.value;
    
    if (!key) {
        alert('Please enter a valid Field Key (letters, numbers, and underscores only).');
        return;
    }
    if (!label) {
        alert('Please enter a Field Label.');
        return;
    }
    
    // Check if key already exists in table
    const existingRows = document.querySelectorAll('#fields-config-table-body tr');
    let duplicate = false;
    existingRows.forEach(row => {
        const firstCellCode = row.querySelector('td code');
        if (firstCellCode && firstCellCode.textContent.trim() === key) {
            duplicate = true;
        }
    });
    
    if (duplicate) {
        alert(`A field with key "${key}" already exists!`);
        return;
    }
    
    // Create new row
    const tbody = document.getElementById('fields-config-table-body');
    const tr = document.createElement('tr');
    
    tr.innerHTML = `
        <td style="padding: 0.6rem 0.8rem;">
            <code style="background: #ECF2FF; padding: 4px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; color: #5D87FF;">${key}</code>
            <input type="hidden" name="fields[${key}][id]" value="${key}">
        </td>
        <td style="padding: 0.6rem 0.8rem;">
            <input type="text" name="fields[${key}][label]" value="${label}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
        </td>
        <td style="padding: 0.6rem 0.8rem;">
            <input type="text" name="fields[${key}][placeholder]" value="${placeholder}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;">
        </td>
        <td style="padding: 0.6rem 0.8rem; text-align: center;">
            <select name="fields[${key}][required]" class="premium-select">
                <option value="1" ${required === '1' ? 'selected' : ''}>Yes</option>
                <option value="0" ${required === '0' ? 'selected' : ''}>No</option>
            </select>
        </td>
        <td style="padding: 0.6rem 0.8rem; text-align: center;">
            <select name="fields[${key}][enabled]" class="premium-select">
                <option value="1" selected>Show</option>
                <option value="0">Hide</option>
            </select>
        </td>
        <td style="padding: 0.6rem 0.8rem; text-align: center;">
            <button type="button" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; font-weight: 700;" onclick="this.closest('tr').remove()" title="Delete Field">Delete</button>
        </td>
    `;
    
    tbody.appendChild(tr);
    
    // Clear inputs
    keyInput.value = '';
    labelInput.value = '';
    placeholderInput.value = '';
    requiredInput.selectedIndex = 1; // default to No
}

window.addNewPassFieldRow = function() {
    const keyInput = document.getElementById('new-pass-field-key');
    const labelInput = document.getElementById('new-pass-field-label');
    
    const rawKey = keyInput.value.trim();
    const key = rawKey.toLowerCase().replace(/[^a-z0-9_]/g, '');
    const label = labelInput.value.trim();
    
    if (!key) {
        alert('Please enter a valid Field Key (letters, numbers, and underscores only).');
        return;
    }
    if (!label) {
        alert('Please enter a Field Label.');
        return;
    }
    
    // Check if key already exists in table
    const existingRows = document.querySelectorAll('#pass-fields-table-body tr');
    let duplicate = false;
    existingRows.forEach(row => {
        const firstCellCode = row.querySelector('td code');
        if (firstCellCode && firstCellCode.textContent.trim() === key) {
            duplicate = true;
        }
    });
    
    if (duplicate) {
        alert(`A field with key "${key}" already exists on the pass!`);
        return;
    }
    
    // Create new row
    const tbody = document.getElementById('pass-fields-table-body');
    const tr = document.createElement('tr');
    
    tr.innerHTML = `
        <td style="padding: 0.6rem 0.8rem;">
            <code style="background: #ECF2FF; padding: 4px 8px; border-radius: 6px; font-size: 0.78rem; font-weight: 600; color: #5D87FF;">${key}</code>
        </td>
        <td style="padding: 0.6rem 0.8rem;">
            <input type="text" name="pass_fields[${key}][label]" value="${label}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
        </td>
        <td style="padding: 0.6rem 0.8rem; text-align: center;">
            <select name="pass_fields[${key}][enabled]" class="premium-select">
                <option value="1" selected>Show</option>
                <option value="0">Hide</option>
            </select>
        </td>
        <td style="padding: 0.6rem 0.8rem; text-align: center;">
            <button type="button" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; font-weight: 700;" onclick="this.closest('tr').remove()" title="Delete Pass Field">Delete</button>
        </td>
    `;
    
    tbody.appendChild(tr);
    
    // Clear inputs
    keyInput.value = '';
    labelInput.value = '';
}

window.addNewFooterLinkRow = function() {
    const labelInput = document.getElementById('new-footer-link-label');
    const urlInput = document.getElementById('new-footer-link-url');
    
    const label = labelInput.value.trim();
    const url = urlInput.value.trim();
    
    if (!label) {
        alert('Please enter a Link Label.');
        return;
    }
    if (!url) {
        alert('Please enter a Link URL.');
        return;
    }
    
    const tbody = document.getElementById('footer-links-table-body');
    const index = tbody.querySelectorAll('tr').length;
    
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td style="padding: 0.6rem 0.8rem;">
            <input type="text" name="footer_links[${index}][label]" value="${label}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
        </td>
        <td style="padding: 0.6rem 0.8rem;">
            <input type="text" name="footer_links[${index}][url]" value="${url}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
        </td>
        <td style="padding: 0.6rem 0.8rem; text-align: center;">
            <select name="footer_links[${index}][enabled]" class="premium-select">
                <option value="1" selected>Show</option>
                <option value="0">Hide</option>
            </select>
        </td>
        <td style="padding: 0.6rem 0.8rem; text-align: center;">
            <button type="button" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; font-weight: 700;" onclick="this.closest('tr').remove()" title="Delete Link">Delete</button>
        </td>
    `;
    
    tbody.appendChild(tr);
    
    labelInput.value = '';
    urlInput.value = '';
}

window.addNewFooterLineRow = function() {
    const textInput = document.getElementById('new-footer-line-text');
    const linkInput = document.getElementById('new-footer-line-link');
    
    const text = textInput.value.trim();
    const link = linkInput.value.trim();
    
    if (!text) {
        alert('Please enter the Line Text.');
        return;
    }
    
    const tbody = document.getElementById('footer-text-lines-table-body');
    const index = tbody.querySelectorAll('tr').length;
    
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td style="padding: 0.6rem 0.8rem;">
            <input type="text" name="footer_text_lines[${index}][text]" value="${text}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;" required>
        </td>
        <td style="padding: 0.6rem 0.8rem;">
            <input type="text" name="footer_text_lines[${index}][link_url]" value="${link}" class="form-control" style="padding: 0.4rem 0.75rem; border-radius: 6px; border: 1px solid #DFE5EF; font-size: 0.825rem; width: 95%;">
        </td>
        <td style="padding: 0.6rem 0.8rem; text-align: center;">
            <button type="button" style="background: #FDEDE8; color: #FA896B; border: none; padding: 0.4rem 0.6rem; border-radius: 6px; cursor: pointer; font-size: 0.75rem; font-weight: 700;" onclick="this.closest('tr').remove()" title="Delete Line">Delete</button>
        </td>
    `;
    
    tbody.appendChild(tr);
    
    textInput.value = '';
    linkInput.value = '';
}
</script>
@endsection
