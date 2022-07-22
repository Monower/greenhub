@include('templates.user_header')
@include('templates.user_navbar')

<div class="container">

<table class="table table-hover">
    <legend>
        <h2>Bookmarks</h2>
    </legend>
    <thead>
      <tr>
        <th scope="col">SI</th>
        <th scope="col">Name of the repository</th>
        <th scope="col">Operation</th>
      </tr>
    </thead>
    <tbody>
      <tr class="table-active">
        <td>1</td>
        <td>C programming</td>
        <td><button class="btn btn-sm btn-dark">Unsave</button></td>
      </tr>
      <tr class="table-active">
        <td>2</td>
        <td>java programming</td>
        <td><button class="btn btn-sm btn-dark">Unsave</button></td>
      </tr>
      <tr class="table-active">
        <td>3</td>
        <td>php programming</td>
        <td><button class="btn btn-sm btn-dark">Unsave</button></td>
      </tr>
      <tr class="table-active">
        <td>4</td>
        <td>python programming</td>
        <td><button class="btn btn-sm btn-dark">Unsave</button></td>
      </tr>
      <tr class="table-active">
        <td>5</td>
        <td>javascript programming</td>
        <td><button class="btn btn-sm btn-dark">Unsave</button></td>
      </tr>
      <tr class="table-active">
        <td>6</td>
        <td>pearl programming</td>
        <td><button class="btn btn-sm btn-dark">Unsave</button></td>
      </tr>
    </tbody>
  </table>
  
  
</div>










@include('templates.user_footer')