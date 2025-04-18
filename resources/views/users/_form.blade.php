@csrf

<div class="form-group">
  <label>Nome</label>
  <input type="text" name="name"
         value="{{ old('name',$user->name ?? '') }}"
         class="form-control @error('name') is-invalid @enderror">
  @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
  <label>Email</label>
  <input type="email" name="email"
         value="{{ old('email',$user->email ?? '') }}"
         class="form-control @error('email') is-invalid @enderror">
  @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
  <label>Telefone</label>
  <input type="text" name="phone"
         value="{{ old('phone',$user->phone ?? '') }}"
         class="form-control @error('phone') is-invalid @enderror">
  @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
  <label>Data de Nascimento</label>
  <input type="date" name="birthday"
         value="{{ old('birthday', isset($user) && $user->birthday ? $user->birthday->format('Y-m-d') : '' ) }}"
         class="form-control @error('birthday') is-invalid @enderror">
  @error('birthday')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="form-group">
  <label>Role</label>
  <select name="role" class="form-control @error('role') is-invalid @enderror">
    @foreach(['user','admin'] as $r)
      <option value="{{ $r }}" {{ old('role',$user->role ?? '')==$r?'selected':'' }}>
        {{ ucfirst($r) }}
      </option>
    @endforeach
  </select>
  @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
