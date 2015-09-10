require 'test_helper'

class ClientMedicalsControllerTest < ActionController::TestCase
  setup do
    @client_medical = client_medicals(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:client_medicals)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create client_medical" do
    assert_difference('ClientMedical.count') do
      post :create, client_medical: @client_medical.attributes
    end

    assert_redirected_to client_medical_path(assigns(:client_medical))
  end

  test "should show client_medical" do
    get :show, id: @client_medical.to_param
    assert_response :success
  end

  test "should get edit" do
    get :edit, id: @client_medical.to_param
    assert_response :success
  end

  test "should update client_medical" do
    put :update, id: @client_medical.to_param, client_medical: @client_medical.attributes
    assert_redirected_to client_medical_path(assigns(:client_medical))
  end

  test "should destroy client_medical" do
    assert_difference('ClientMedical.count', -1) do
      delete :destroy, id: @client_medical.to_param
    end

    assert_redirected_to client_medicals_path
  end
end
