# Auth & Layout

## Overview
- Laravel Breeze scaffolds all authentication — login, register, 
  logout, session management, password hashing
- No auth logic written manually — Breeze is battle-tested and 
  fighting its defaults would waste development time
- Breeze's default Tailwind/Alpine stack replaced with Bootstrap — 
  two CSS frameworks on the same page conflict; Bootstrap was chosen 
  to match the project brief
- `email_verified_at` middleware removed from dashboard route — 
  email sending is out of scope; architecture remains intact, 
  restore `'verified'` to the middleware array when SMTP is configured

## Layout Shell — layouts/app.blade.php
- Single shared layout that every page in the app extends
- Navbar, flash messages, and `@yield('content')` live here
- Every page uses `@extends('layouts.app')` and fills 
  `@section('content')` — one layout change propagates everywhere
- Breeze's guest layout (`layouts/guest.blade.php`) kept for 
  login and register pages — centered auth forms don't need a navbar

## Navbar
- Three states handled in one navbar:
  - Guest → Login, Register
  - Student (is_admin = false) → Dashboard, Logout
  - Admin (is_admin = true) → Admin Panel, Logout
- State detection via `@guest` / `@auth` Blade directives and 
  `Auth::user()->is_admin` check
- Logout uses POST form with `@csrf` — logout must be a POST 
  request, never GET, because it mutates server state (destroys session)
- Bootstrap `navbar-expand-lg` handles mobile collapse automatically — 
  hamburger button on small screens, full links on large screens

## Flash Messages
- Two flash message types: `success` (green) and `error` (red)
- Rendered in layout shell so every page gets them for free
- Controllers flash messages via `session('success', 'message')` 
  and `session('error', 'message')` — consumed once then gone

## Routes
- `/` → `courses.index` placeholder — real course listing built Day 5
- `/dashboard` → placeholder — real enrolled courses built Day 6
- `/login`, `/register`, `/logout` → Breeze handles these via 
  `routes/auth.php`
- All Breeze profile routes kept but unused in this project scope