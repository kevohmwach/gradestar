@extends('layouts.site')

@section('content')

<div class="containerr">
    <div class="prod_create_container">
        <form action="{{route('productUpdate', ['id'=>$product->id])}}" method="post" enctype="multipart/form-data" class="product_create_form" >
            @csrf
            @method('PATCH')
            
            <div>
                <label  class="label">Title/Url</label>

                <input id="prod_title" type="text"  class="form-control @error('prod_title') is-invalid @enderror" name="prod_title" value="{{ old('prod_title',$product->prod_title) }}" required autocomplete="prod_title" autofocus>
                @error('prod_title')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Meta Title</label>

                <input id="prod_meta_title" type="text"  class="form-control @error('prod_meta_title') is-invalid @enderror" name="prod_meta_title" value="{{ old('prod_meta_title',$product->prod_meta_title) }}" required autocomplete="prod_meta_title" autofocus>
                @error('prod_meta_title')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Description</label>

                <textarea rows="3" id="prod_description" class="form-control @error('prod_description') is-invalid @enderror" name="prod_description" required autocomplete="prod_description" autofocus>{{ old('prod_description',$product->prod_description) }}
                </textarea>
                @error('prod_description')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Meta Description</label>

                <textarea rows="3" id="prod_meta_description" class="form-control @error('prod_meta_description') is-invalid @enderror" name="prod_meta_description" required autocomplete="prod_meta_description" autofocus>{{ old('prod_meta_description',$product->prod_meta_description) }}</textarea>
                @error('prod_meta_description')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Category</label>

                <input id="prod_category" type="text"  class="form-control @error('prod_category') is-invalid @enderror" name="prod_category" value="{{ old('prod_category',$product->prod_category) }}" required autocomplete="prod_category" autofocus>
                @error('prod_category')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">ISBN</label>

                <input id="prod_isbn" type="text"  class="form-control @error('prod_isbn') is-invalid @enderror" name="prod_isbn" value="{{ old('prod_isbn',$product->prod_isbn) }}"  autocomplete="prod_isbn" autofocus>
                @error('prod_isbn')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Course</label>

                <input id="prod_course" type="text"  class="form-control @error('prod_course') is-invalid @enderror" name="prod_course" value="{{ old('prod_course',$product->prod_course) }}" required autocomplete="prod_course" autofocus>
                @error('prod_course')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Product file</label>

                <input id="prod_file" type="file"  class="form-control @error('prod_file') is-invalid @enderror" name="prod_file" value="{{ old('prod_file',$product->prod_file) }}"  autocomplete="prod_file" autofocus>
                @error('prod_file')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Product image</label>

                <input id="prod_image" type="file"  class="form-control @error('prod_image') is-invalid @enderror" name="prod_image" value="{{ old('prod_image',$product->prod_image) }}"  autocomplete="prod_image" autofocus>
                @error('prod_image')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Product preview file</label>

                <input id="prod_preview" type="file"  class="form-control @error('prod_preview') is-invalid @enderror" name="prod_preview" value="{{ old('prod_preview',$product->prod_preview) }}"  autocomplete="prod_preview" autofocus>
                @error('prod_preview')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Price</label>

                <input id="prod_actualPrice" type="number" step="any"  class="form-control @error('prod_actualPrice') is-invalid @enderror" name="prod_actualPrice" value="{{ old('prod_actualPrice',$product->prod_actualPrice) }}" required autocomplete="prod_actualPrice" autofocus>
                @error('prod_actualPrice')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Percentage Discount</label>

                <input id="prod_Percent_discount" type="number" step="any"  class="form-control @error('prod_Percent_discount') is-invalid @enderror" name="prod_Percent_discount" value="{{ old('prod_Percent_discount',$product->prod_Percent_discount) }}" required autocomplete="prod_Percent_discount" autofocus>
                @error('prod_Percent_discount')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Key words</label>
                <textarea rows="3" id="prod_keywords" class="form-control @error('prod_keywords') is-invalid @enderror" name="prod_keywords" required autocomplete="prod_keywords" autofocus>{{ old('prod_keywords',$product->prod_keywords) }}</textarea>
                @error('prod_keywords')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- <div>
                <label  class="label">Discounted Price</label>

                <input id="prod_disctPrice" type="number"  class="form-control @error('prod_disctPrice') is-invalid @enderror" name="prod_disctPrice" value="{{ old('prod_disctPrice') }}" required autocomplete="prod_disctPrice" autofocus>
                @error('prod_disctPrice')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}
            {{-- <div>
                <label  class="label">Key word 1</label>

                <input id="prod_keyword1" type="text"  class="form-control @error('prod_keyword1') is-invalid @enderror" name="prod_keyword1" value="{{ old('prod_keyword1') }}" required autocomplete="prod_keyword1" autofocus>
                @error('prod_keyword1')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Key word 2</label>

                <input id="prod_keyword2" type="text"  class="form-control @error('prod_keyword2') is-invalid @enderror" name="prod_keyword2" value="{{ old('prod_keyword2') }}" required autocomplete="prod_keyword2" autofocus>
                @error('prod_keyword2')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Key word 3</label>

                <input id="prod_keyword3" type="text"  class="form-control @error('prod_keyword3') is-invalid @enderror" name="prod_keyword3" value="{{ old('prod_keyword3') }}" required autocomplete="prod_keyword3" autofocus>
                @error('prod_keyword3')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}

            {{-- <div>
                <label  class="label">Preview pages</label>
                <textarea rows="20" id="prod_preview" class="form-control @error('prod_preview') is-invalid @enderror" name="prod_preview" value="{{ old('prod_preview') }}" required autocomplete="prod_preview" autofocus></textarea>
                @error('prod_preview')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}

            <div>
                <label  class="label">H2 Heading</label>

                <input id="prod_overview1_h2" type="text"  class="form-control @error('prod_overview1_h2') is-invalid @enderror" name="prod_overview1_h2" value="{{ old('prod_overview1_h2',$product->prod_overview1_h2) }}" autocomplete="prod_overview1_h2" autofocus>
                @error('prod_overview1_h2')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Section Description</label>

                <textarea rows="3" id="prod_overview1_descriprion" class="form-control @error('prod_overview1_descriprion') is-invalid @enderror" name="prod_overview1_descriprion"  autocomplete="prod_overview1_descriprion" autofocus>{{ old('prod_overview1_descriprion',$product->prod_overview1_descriprion) }}</textarea>
                @error('prod_overview1_descriprion')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">H2 Heading</label>

                <input id="prod_overview2_h2" type="text"  class="form-control @error('prod_overview2_h2') is-invalid @enderror" name="prod_overview2_h2" value="{{ old('prod_overview2_h2',$product->prod_overview2_h2) }}" autocomplete="prod_overview2_h2" autofocus>
                @error('prod_overview2_h2')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Section Description</label>

                <textarea rows="3" id="prod_overview2_descriprion" class="form-control @error('prod_overview2_descriprion') is-invalid @enderror" name="prod_overview2_descriprion"  autocomplete="prod_overview2_descriprion" autofocus>{{ old('prod_overview2_descriprion',$product->prod_overview2_descriprion) }}</textarea>
                @error('prod_overview2_descriprion')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div>
                <label  class="label">H2 Heading</label>

                <input id="prod_overview3_h2" type="text"  class="form-control @error('prod_overview3_h2') is-invalid @enderror" name="prod_overview3_h2" value="{{ old('prod_overview3_h2',$product->prod_overview3_h2) }}" autocomplete="prod_overview3_h2" autofocus>
                @error('prod_overview3_h2')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Section Description</label>

                <textarea rows="3" id="prod_overview3_descriprion" class="form-control @error('prod_overview3_descriprion') is-invalid @enderror" name="prod_overview3_descriprion"  autocomplete="prod_overview3_descriprion" autofocus>{{ old('prod_overview3_descriprion',$product->prod_overview3_descriprion) }}</textarea>
                @error('prod_overview3_descriprion')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div>
                <label  class="label">H2 Heading</label>

                <input id="prod_overview4_h2" type="text"  class="form-control @error('prod_overview4_h2') is-invalid @enderror" name="prod_overview4_h2" value="{{ old('prod_overview4_h2',$product->prod_overview4_h2) }}" autocomplete="prod_overview4_h2" autofocus>
                @error('prod_overview4_h2')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Section Description</label>

                <textarea rows="3" id="prod_overview4_descriprion" class="form-control @error('prod_overview4_descriprion') is-invalid @enderror" name="prod_overview4_descriprion"  autocomplete="prod_overview4_descriprion" autofocus>{{ old('prod_overview4_descriprion',$product->prod_overview4_descriprion) }}</textarea>
                @error('prod_overview4_descriprion')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div>
                <label  class="label">H2 Heading</label>

                <input id="prod_overview5_h2" type="text"  class="form-control @error('prod_overview5_h2') is-invalid @enderror" name="prod_overview5_h2" value="{{ old('prod_overview5_h2',$product->prod_overview5_h2) }}" autocomplete="prod_overview5_h2" autofocus>
                @error('prod_overview5_h2')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Section Description</label>

                <textarea rows="3" id="prod_overview5_descriprion" class="form-control @error('prod_overview5_descriprion') is-invalid @enderror" name="prod_overview5_descriprion"  autocomplete="prod_overview5_descriprion" autofocus>{{ old('prod_overview5_descriprion',$product->prod_overview5_descriprion) }}</textarea>
                @error('prod_overview5_descriprion')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div>
                <label  class="label">H2 Heading</label>

                <input id="prod_overview6_h2" type="text"  class="form-control @error('prod_overview6_h2') is-invalid @enderror" name="prod_overview6_h2" value="{{ old('prod_overview6_h2',$product->prod_overview6_h2) }}" autocomplete="prod_overview6_h2" autofocus>
                @error('prod_overview6_h2')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Section Description</label>

                <textarea rows="3" id="prod_overview6_descriprion" class="form-control @error('prod_overview6_descriprion') is-invalid @enderror" name="prod_overview6_descriprion"  autocomplete="prod_overview6_descriprion" autofocus>{{ old('prod_overview6_descriprion',$product->prod_overview6_descriprion) }}</textarea>
                @error('prod_overview6_descriprion')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">H2 Heading</label>

                <input id="prod_overview7_h2" type="text"  class="form-control @error('prod_overview7_h2') is-invalid @enderror" name="prod_overview7_h2" value="{{ old('prod_overview7_h2',$product->prod_overview7_h2) }}" autocomplete="prod_overview7_h2" autofocus>
                @error('prod_overview7_h2')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div>
                <label  class="label">Section Description</label>

                <textarea rows="3" id="prod_overview7_descriprion" class="form-control @error('prod_overview7_descriprion') is-invalid @enderror" name="prod_overview7_descriprion"  autocomplete="prod_overview7_descriprion" autofocus>{{ old('prod_overview7_descriprion',$product->prod_overview7_descriprion) }}</textarea>
                @error('prod_overview7_descriprion')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div>
                <label  class="label">Extra Content</label>
                <textarea rows="20" id="prod_extraContent" class="form-control @error('prod_extraContent') is-invalid @enderror" name="prod_extraContent"  required autocomplete="prod_extraContent" autofocus>{{ old('prod_extraContent',$product->prod_extraContent) }}</textarea>
                @error('prod_extraContent')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- <div>
                <label  class="label">Sample Question 1 - Required</label>
                <textarea rows="5" id="prod_samplequiz_1" class="form-control @error('prod_samplequiz_1') is-invalid @enderror" name="prod_samplequiz_1" value="{{ old('prod_samplequiz_1') }}" required autocomplete="prod_samplequiz_1" autofocus></textarea>
                @error('prod_samplequiz_1')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Sample Answer 1 -Optional</label>
                <textarea rows="3" id="prod_sampleansw_1" class="form-control @error('prod_sampleansw_1') is-invalid @enderror" name="prod_sampleansw_1" value="{{ old('prod_sampleansw_1') }}" autocomplete="prod_sampleansw_1" autofocus></textarea>
                @error('prod_sampleansw_1')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Sample Question 2 - Required</label>
                <textarea rows="5" id="prod_samplequiz_2" class="form-control @error('prod_samplequiz_2') is-invalid @enderror" name="prod_samplequiz_2" value="{{ old('prod_samplequiz_2') }}" required autocomplete="prod_samplequiz_2" autofocus></textarea>
                @error('prod_samplequiz_2')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Sample Answer 2 -Optional</label>
                <textarea rows="3" id="prod_sampleansw_2" class="form-control @error('prod_sampleansw_2') is-invalid @enderror" name="prod_sampleansw_2" value="{{ old('prod_sampleansw_2') }}"  autocomplete="prod_sampleansw_2" autofocus></textarea>
                @error('prod_sampleansw_2')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Sample Question 3 - Optional</label>
                <textarea rows="5" id="prod_samplequiz_3" class="form-control @error('prod_samplequiz_3') is-invalid @enderror" name="prod_samplequiz_3" value="{{ old('prod_samplequiz_3') }}"  autocomplete="prod_samplequiz_3" autofocus></textarea>
                @error('prod_samplequiz_3')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Sample Answer 3 -Optional</label>
                <textarea rows="3" id="prod_sampleansw_3" class="form-control @error('prod_sampleansw_3') is-invalid @enderror" name="prod_sampleansw_3" value="{{ old('prod_sampleansw_3') }}"  autocomplete="prod_sampleansw_3" autofocus></textarea>
                @error('prod_sampleansw_3')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Sample Question 4 - Optional</label>
                <textarea rows="5" id="prod_samplequiz_4" class="form-control @error('prod_samplequiz_4') is-invalid @enderror" name="prod_samplequiz_4" value="{{ old('prod_samplequiz_4') }}"  autocomplete="prod_samplequiz_4" autofocus></textarea>
                @error('prod_samplequiz_4')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <label  class="label">Sample Answer 4 -Optional</label>
                <textarea rows="3" id="prod_sampleansw_4" class="form-control @error('prod_sampleansw_4') is-invalid @enderror" name="prod_sampleansw_4" value="{{ old('prod_sampleansw_4') }}"  autocomplete="prod_sampleansw_4" autofocus></textarea>
                @error('prod_sampleansw_4')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}

            <div class="prod-create-button">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
            
            
        </form>
    </div>
</div>

@endsection