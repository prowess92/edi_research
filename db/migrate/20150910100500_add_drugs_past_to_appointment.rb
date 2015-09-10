class AddDrugsPastToAppointment < ActiveRecord::Migration
  def change
    add_column :appointments, :drugs_past, :decimal
  end
end
